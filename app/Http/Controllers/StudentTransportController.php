<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Student_Transport;
use Illuminate\Support\Facades\DB;

class StudentTransportController extends Controller
{
    public function index()
    {
        // Fetch student transports with joined data
        $studentTransports = DB::table('student__transports')
            ->join('student_records', 'student__transports.student_id', '=', 'student_records.id')
            ->join('users', 'student_records.user_id', '=', 'users.id') // Assuming `student_records` links to `users`
            ->join('vehicles', 'student__transports.vehicle_id', '=', 'vehicles.id')
            ->join('routes', 'student__transports.route_id', '=', 'routes.id')
            ->select(
                'student__transports.id',
                'users.name as student_name', // Fetch student name from `users`
                'vehicles.vehicle_type as vehicle_name', // Renamed alias to match in the view
                'routes.route_name',
                // 'studen_records.destination',
                'student__transports.created_at'
            )
            ->get();
    
        // Fetch additional data for form options
        $students = DB::table('student_records')
            ->join('users', 'student_records.user_id', '=', 'users.id')
            ->select('student_records.id', 'users.name as student_name')
            ->get();
    
        $vehicles = DB::table('vehicles')->select('id', 'vehicle_type')->get();
        $routes = DB::table('routes')->select('id', 'route_name')->get();
    
        return view('transports.index', compact('studentTransports', 'students', 'vehicles', 'routes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student_records,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        // Insert data using raw SQL
        DB::table('student__transports')->insert([
            'student_id' => $request->student_id,
            'vehicle_id' => $request->vehicle_id,
            'route_id' => $request->route_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Student transport assigned successfully!');
    }

    public function destroy($id)
    {
        // Delete record using raw SQL
        DB::table('student__transports')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Record deleted successfully!');
    }
}
