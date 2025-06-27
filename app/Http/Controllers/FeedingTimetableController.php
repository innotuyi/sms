<?php

namespace App\Http\Controllers;

use App\Models\FeedingTimetable;
use Illuminate\Http\Request;

class FeedingTimetableController extends Controller
{
    public function index()
    {
        $timetables = FeedingTimetable::where('school_id', auth()->user()->school_id)
            ->orderBy('day_of_week')
            ->get();
        
        return view('pages.school_info.feeding_timetables.index', compact('timetables'));
    }

    public function create()
    {
        return view('pages.school_info.feeding_timetables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'morning_meal' => 'required|string',
            'lunch_meal' => 'required|string',
            'dinner_meal' => 'required|string',
            'special_notes' => 'nullable|string'
        ]);

        $validated['school_id'] = auth()->user()->school_id;
        
        FeedingTimetable::create($validated);

        return redirect()->route('feeding-timetables.index')
            ->with('message', 'Feeding timetable entry created successfully');
    }

    public function edit(FeedingTimetable $feedingTimetable)
    {
        return view('pages.school_info.feeding_timetables.edit', compact('feedingTimetable'));
    }

    public function update(Request $request, FeedingTimetable $feedingTimetable)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'morning_meal' => 'required|string',
            'lunch_meal' => 'required|string',
            'dinner_meal' => 'required|string',
            'special_notes' => 'nullable|string'
        ]);

        $feedingTimetable->update($validated);

        return redirect()->route('feeding-timetables.index')
            ->with('message', 'Feeding timetable entry updated successfully');
    }

    public function destroy(FeedingTimetable $feedingTimetable)
    {
        $feedingTimetable->delete();

        return redirect()->route('feeding-timetables.index')
            ->with('message', 'Feeding timetable entry deleted successfully');
    }
} 