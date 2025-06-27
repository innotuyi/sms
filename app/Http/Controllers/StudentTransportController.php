<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRecord;
use App\Models\Vehicle;
use App\Models\Route;
use App\Models\Student_Transport;
use Illuminate\Support\Facades\DB;

class StudentTransportController extends SchoolBaseController
{
    public function index()
    {
        $schoolId = $this->getSchoolId();
        
        // Fetch student transports with joined data
        $studentTransports = DB::table('student__transports')
            ->join('student_records', 'student__transports.student_id', '=', 'student_records.id')
            ->join('users', 'student_records.user_id', '=', 'users.id')
            ->join('vehicles', 'student__transports.vehicle_id', '=', 'vehicles.id')
            ->join('routes', 'student__transports.route_id', '=', 'routes.id')
            ->where('student_records.school_id', $schoolId)
            ->select(
                'student__transports.id',
                'users.name as student_name',
                'vehicles.vehicle_type as vehicle_name',
                'routes.route_name',
                'student__transports.created_at'
            )
            ->get();
    
        // Fetch additional data for form options
        $students = DB::table('student_records')
            ->join('users', 'student_records.user_id', '=', 'users.id')
            ->where('student_records.school_id', $schoolId)
            ->select('student_records.id', 'users.name as student_name')
            ->get();
    
        $vehicles = DB::table('vehicles')
            ->where('school_id', $schoolId)
            ->select('id', 'vehicle_type')
            ->get();
            
        $routes = DB::table('routes')
            ->where('school_id', $schoolId)
            ->select('id', 'route_name')
            ->get();
    
        return view('transports.index', compact('studentTransports', 'students', 'vehicles', 'routes'));
    }
    
    public function store(Request $request)
    {
        $schoolId = $this->getSchoolId();
        
        // Verify student belongs to school
        $student = DB::selectOne(
            'SELECT * FROM student_records WHERE id = ? AND school_id = ?',
            [$request->student_id, $schoolId]
        );

        // Verify vehicle belongs to school
        $vehicle = DB::selectOne(
            'SELECT * FROM vehicles WHERE id = ? AND school_id = ?',
            [$request->vehicle_id, $schoolId]
        );

        // Verify route belongs to school
        $route = DB::selectOne(
            'SELECT * FROM routes WHERE id = ? AND school_id = ?',
            [$request->route_id, $schoolId]
        );

        if (!$student || !$vehicle || !$route) {
            abort(403, 'Unauthorized action.');
        }

        Student_Transport::create([
            'student_id' => $request->student_id,
            'vehicle_id' => $request->vehicle_id,
            'route_id' => $request->route_id,
            'school_id' => $schoolId
        ]);

        return redirect()->route('student_transport.index')->with('success', 'Student transport assigned successfully!');
    }

    public function update(Request $request, $id)
    {
        $schoolId = $this->getSchoolId();
        
        // Verify transport record belongs to school
        $transport = Student_Transport::findOrFail($id);
        $student = StudentRecord::findOrFail($transport->student_id);
        
        if ($student->school_id != $schoolId) {
            abort(403, 'Unauthorized action.');
        }

        // Verify vehicle belongs to school
        $vehicle = DB::selectOne(
            'SELECT * FROM vehicles WHERE id = ? AND school_id = ?',
            [$request->vehicle_id, $schoolId]
        );

        // Verify route belongs to school
        $route = DB::selectOne(
            'SELECT * FROM routes WHERE id = ? AND school_id = ?',
            [$request->route_id, $schoolId]
        );

        if (!$vehicle || !$route) {
            abort(403, 'Unauthorized action.');
        }

        $transport->update([
            'vehicle_id' => $request->vehicle_id,
            'route_id' => $request->route_id
        ]);

        return redirect()->route('student_transport.index')->with('success', 'Student transport updated successfully!');
    }

    public function destroy($id)
    {
        $schoolId = $this->getSchoolId();
        
        // Verify transport record belongs to school
        $transport = Student_Transport::findOrFail($id);
        $student = StudentRecord::findOrFail($transport->student_id);
        
        if ($student->school_id != $schoolId) {
            abort(403, 'Unauthorized action.');
        }

        $transport->delete();
        return redirect()->route('student_transport.index')->with('success', 'Student transport deleted successfully!');
    }
}
