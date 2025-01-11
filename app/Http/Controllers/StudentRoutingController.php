<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Student_Transport;
use App\Models\StudentRecord;
use App\Models\vehicle;
use Illuminate\Http\Request;

class StudentRoutingController extends Controller
{
    
    
    public function index()
    {
        $studentTransports = Student_Transport::with(['student', 'vehicle', 'route'])->get(); 
        
        return view('routing.index', compact('studentTransports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:student_records,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        Student_Transport::create($request->all());

        return redirect()->route('transports.transport')->with('success', 'Student transport record added successfully.');
    }

    public function edit($id)
    {
        $studentTransport = Student_Transport::findOrFail($id);
        $students = StudentRecord::all();
        $vehicles = vehicle::all();
        $routes = Route::all();

        return view('student_transport.edit', compact('studentTransport', 'students', 'vehicles', 'routes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:student_records,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
        ]);

        $studentTransport = Student_Transport::findOrFail($id);
        $studentTransport->update($request->all());

        return redirect()->route('transports.transport')->with('success', 'Student transport record updated successfully.');
    }

    public function destroy($id)
    {
        $studentTransport = Student_Transport::findOrFail($id);
        $studentTransport->delete();

        return redirect()->route('transports.transport')->with('success', 'Student transport record deleted successfully.');
    }
}
