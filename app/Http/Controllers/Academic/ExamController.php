<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\SchoolBaseController;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends SchoolBaseController
{
    public function index()
    {
        $data = $this->getSchoolData();
        $data['exams'] = $this->scopeToSchool(Exam::query())
            ->with(['class', 'subject'])
            ->get();
        return view('pages.academic.exams.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'class_id' => 'required|exists:my_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ]);

        $data = $request->all();
        $data['school_id'] = $this->getSchoolId();
        
        Exam::create($data);
        return redirect()->back()->with('flash_success', 'Exam created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'class_id' => 'required|exists:my_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time'
        ]);

        $exam = Exam::findOrFail($id);
        $this->checkSchoolAccess($exam->school_id);
        
        $exam->update($request->all());
        return redirect()->back()->with('flash_success', 'Exam updated successfully');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $this->checkSchoolAccess($exam->school_id);
        
        $exam->delete();
        return redirect()->back()->with('flash_success', 'Exam deleted successfully');
    }
} 