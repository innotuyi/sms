<?php

namespace App\Http\Controllers;

use App\Models\VisitingSchedule;
use App\Models\School;
use Illuminate\Http\Request;
use App\Helpers\Qs;

class VisitingScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teamSA');
    }

    public function index()
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        $school = School::find(auth()->user()->school_id);
        if (!$school) {
            return back()->with('error', 'School details not found.');
        }

        $schedules = VisitingSchedule::where('school_id', $school->id)
            ->orderBy('visiting_date')
            ->get();
        
        return view('pages.school_info.visiting_schedules.index', compact('schedules', 'school'));
    }

    public function create()
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        $school = School::find(auth()->user()->school_id);
        if (!$school) {
            return back()->with('error', 'School details not found.');
        }
        return view('pages.school_info.visiting_schedules.create', compact('school'));
    }

    public function store(Request $request)
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        $school = School::find(auth()->user()->school_id);
        if (!$school) {
            return back()->with('error', 'School details not found.');
        }

        $validated = $request->validate([
            'month' => 'required|string',
            'visiting_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'special_instructions' => 'nullable|string'
        ]);

        $validated['school_id'] = $school->id;
        
        VisitingSchedule::create($validated);

        return redirect()->route('visiting-schedules.index')
            ->with('message', 'Visiting schedule created successfully');
    }

    public function edit(VisitingSchedule $visitingSchedule)
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        if ($visitingSchedule->school_id !== auth()->user()->school_id) {
            return back()->with('error', 'Unauthorized access.');
        }
        return view('pages.school_info.visiting_schedules.edit', compact('visitingSchedule'));
    }

    public function update(Request $request, VisitingSchedule $visitingSchedule)
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        if ($visitingSchedule->school_id !== auth()->user()->school_id) {
            return back()->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'month' => 'required|string',
            'visiting_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'special_instructions' => 'nullable|string'
        ]);

        $visitingSchedule->update($validated);

        return redirect()->route('visiting-schedules.index')
            ->with('message', 'Visiting schedule updated successfully');
    }

    public function destroy(VisitingSchedule $visitingSchedule)
    {
        if (!Qs::userIsTeamSA()) {
            return back()->with('error', 'Access denied.');
        }

        if ($visitingSchedule->school_id !== auth()->user()->school_id) {
            return back()->with('error', 'Unauthorized access.');
        }

        $visitingSchedule->delete();

        return redirect()->route('visiting-schedules.index')
            ->with('message', 'Visiting schedule deleted successfully');
    }

    public function showForSchool(School $school)
    {
        $schedules = VisitingSchedule::where('school_id', $school->id)
            ->orderBy('visiting_date')
            ->get();
        
        return view('pages.school_info.visiting_schedules.show', compact('schedules', 'school'));
    }
} 