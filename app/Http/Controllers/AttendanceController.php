<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index($sectionId = null)
    {
        $teacherId = auth()->id();
    
        // Automatically fetch the sectionId if it's not provided
        if (!$sectionId) {
            $section = DB::selectOne(
                'SELECT * FROM sections WHERE teacher_id = ?',
                [$teacherId]
            );
    
            if (!$section) {
                abort(403, 'Unauthorized action. You are not assigned to any section.');
            }
    
            $sectionId = $section->id;
        }
    
        // Ensure teacher can only view attendance for their assigned section
        $section = DB::selectOne(
            'SELECT * FROM sections WHERE id = ? AND teacher_id = ?',
            [$sectionId, $teacherId]
        );
    
        if (!$section) {
            abort(403, 'Unauthorized action.');
        }
    
        // Retrieve attendance records for the section
        $attendances = DB::select(
            'SELECT a.*, s.adm_no, s.user_id, u.name as student_name
             FROM attendances a
             JOIN student_records s ON a.student_id = s.id
             JOIN users u ON s.user_id = u.id
             WHERE a.section_id = ?
             ORDER BY a.attendance_date DESC',
            [$sectionId]
        );
    
        // Fetch students for the section with their names
        $students = DB::select(
            'SELECT sr.id, u.name 
             FROM student_records sr
             JOIN users u ON sr.user_id = u.id
             WHERE sr.section_id = ?',
            [$sectionId]
        );
    
        return view('attendance.index', compact('attendances', 'section', 'students'));
    }
    
    
    





    public function store(Request $request)
{
    $request->validate([
        'section_id' => 'required|exists:sections,id',
        'attendance' => 'required|array',
        'attendance.*' => 'in:present,absent',  // Ensure each attendance value is present or absent
    ]);

    $teacherId = auth()->id(); // Get the logged-in teacher's ID
    $attendanceDate = now()->format('Y-m-d');

    foreach ($request->attendance as $studentId => $status) {
        DB::insert(
            'INSERT INTO attendances (student_id, teacher_id, section_id, attendance_date, status, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?)',
            [
                $studentId,
                $teacherId,
                $request->section_id,
                $attendanceDate,
                $status,
                now(),
                now()
            ]
        );
    }

    return back()->with('success', 'Attendance recorded successfully!');
}

}
