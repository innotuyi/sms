<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{



    // View the list of permissions (for both parent and headmaster)
    public function index()
    {
        // Get the permissions with student and parent names directly
        $permissions = DB::table('persmissions')
            ->join('student_records', 'persmissions.student_id', '=', 'student_records.id')
            ->join('users as student_users', 'student_records.user_id', '=', 'student_users.id')  // Get student's name
            ->join('users as parent_users', 'persmissions.parent_id', '=', 'parent_users.id')  // Get parent's name
            ->select('persmissions.*', 'student_users.name as student_name', 'parent_users.name as parent_name')
            ->get()
            ->map(function ($request) {
                // Convert created_at to a Carbon instance
                $request->created_at = Carbon::parse($request->created_at);
                return $request;
            });

        return view('permissions.index', compact('permissions'));
    }


    // Parent Request Permission

    public function requestPermission(Request $request, $student_id)
    {
        // Get the parent ID (logged-in user)
        $parent_id = Auth::user()->id;

        // Ensure the logged-in user is the parent of the student
        $student = DB::table('student_records')
            ->where('id', $student_id)
            ->first();

        if (!$student || $student->my_parent_id != $parent_id) {
            return redirect()->back()->with('error', 'You do not have permission to request for this student.');
        }

        // Insert a new permission request into the permissions table
        DB::table('persmissions')->insert([
            'student_id' => $student_id,
            'parent_id' => $parent_id,
            'status' => 'pending',
            'reason' => $request->input('reason'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Permission request sent successfully.');

    }




    public function updatePermissionStatus(Request $request, $permission_id) 
    {
        // Check if the logged-in user is the headmaster
        if (Auth::user()->user_type !== 'super_admin') {
            return redirect()->back()->with('error', 'You are not authorized to approve or reject this request.');
        }
    
        // Validate the status input
        $request->validate([
            'status' => 'required|in:approved,rejected', // Ensure only valid statuses are allowed
        ]);
    
        // Get the status value from the form
        $status = $request->input('status');
    
        // Retrieve the current permission record
        $permission = DB::table('persmissions')->where('id', $permission_id)->first();
    
        if (!$permission) {
            return redirect()->back()->with('error', 'Permission request not found.');
        }
    
        // Set or retain the value for `days_with_parent`
        $daysWithParent = $permission->days_with_parent ?? 0; // Default to 0 if null
    
        // Update the permission status in the database
        DB::table('persmissions')->where('id', $permission_id)->update([
            'status' => $status,
            'days_with_parent' => $daysWithParent, // Explicitly retain or set value
            'updated_at' => now(),
        ]);
    
        // Fetch updated permissions for the parent permissions view
        $permissions = DB::table('persmissions')
            ->join('student_records', 'persmissions.student_id', '=', 'student_records.id')
            ->join('users', 'student_records.user_id', '=', 'users.id')
            ->select(
                'persmissions.id AS permission_id',
                'users.name AS student_name',
                'persmissions.reason',
                'persmissions.created_at AS request_date',
                'persmissions.status',
                'persmissions.days_with_parent'
            )
            ->where('student_records.my_parent_id', Auth::user()->id) // Adjust as needed for parent or headmaster permissions
            ->orderBy('persmissions.created_at', 'DESC')
            ->get();
    
        return redirect()->route('permissions.index')->with('success', 'Permission request updated successfully.');
    }
    
    



    // In your PermissionController
    public function update(Request $request, $id)
    {
        // Ensure the status is valid
        $status = $request->input('status');
        if (in_array($status, ['approved', 'rejected'])) {
            // Use raw SQL to update the permission status
            DB::table('persmissions')
                ->where('id', $id)
                ->update(['status' => $status]);
        }

        // Redirect back with success message
        return redirect()->route('permissions.index')->with('success', 'Permission request updated successfully.');
    }


    public function childPermissions()
    {
        // Get the logged-in parent's ID
        $parentId = auth()->user()->id;
    
        // Raw SQL query to fetch child permissions with the user's name
        $permissions = DB::select("
            SELECT 
                p.id AS permission_id,
                u.name AS student_name,
                p.reason,
                p.created_at AS request_date,
                p.status,
                p.days_with_parent
            FROM persmissions p
            INNER JOIN student_records s ON p.student_id = s.id
            INNER JOIN users u ON s.user_id = u.id
            WHERE s.my_parent_id  = ?
            ORDER BY p.created_at DESC
        ", [$parentId]);
    
        // Pass the data to the view
        return view('pages.parent.permissions', ['permissions' => $permissions]);
    }
    
}
