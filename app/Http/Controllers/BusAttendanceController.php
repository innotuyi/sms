<?php

namespace App\Http\Controllers;

use App\Models\Bus_Attendance;
use App\Models\Route;
use App\Models\StudentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusAttendanceController extends Controller
{
    public function index()
{
    // Fetch bus attendances with student name and route name using raw SQL
    $busAttendances = DB::table('bus__attendances')
        ->join('student_records', 'bus__attendances.student_id', '=', 'student_records.id')
        ->join('users', 'student_records.user_id', '=', 'users.id') // Join with users table for student name
        ->join('routes', 'bus__attendances.route_id', '=', 'routes.id') // Join with routes table for route name
        ->select(
            'bus__attendances.id',
            'users.name as student_name',  // Alias for student name
            'routes.route_name',           // Alias for route name
            'bus__attendances.date',
            'bus__attendances.time',
            'bus__attendances.present'
        )
        ->get();

    // Fetch students for the dropdown
    $students = DB::table('student_records')
        ->join('users', 'student_records.user_id', '=', 'users.id')
        ->select('student_records.id', 'users.name as student_name')
        ->get();

    // Fetch routes for the dropdown
    $routes = DB::table('routes')->select('id', 'route_name')->get();

    return view('bus_attendance.index', compact('busAttendances', 'students', 'routes'));
}


    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student_records,id',
            'route_id' => 'required|exists:routes,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'present' => 'required|boolean',
        ]);

        Bus_Attendance::create($request->all());

        return redirect()->route('bus_attendance.index')->with('success', 'Attendance recorded successfully.');
    }

    public function edit($id)
    {
        $attendance = Bus_Attendance::findOrFail($id);
        $students = StudentRecord::all();
        $routes = Route::all();

        return view('bus_attendance.edit', compact('attendance', 'students', 'routes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:student_records,id',
            'route_id' => 'required|exists:routes,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'present' => 'required|boolean',
        ]);

        $attendance = Bus_Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect()->route('bus_attendance.index')->with('success', 'Attendance updated successfully.');
    }

    public function destroy($id)
    {
        $attendance = Bus_Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('bus_attendance.index')->with('success', 'Attendance deleted successfully.');
    }
}
