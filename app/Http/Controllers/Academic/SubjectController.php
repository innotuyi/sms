<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\SchoolBaseController;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends SchoolBaseController
{
    public function index()
    {
        $data = $this->getSchoolData();
        $data['subjects'] = $this->scopeToSchool(Subject::query())
            ->with('class')
            ->get();
        return view('pages.academic.subjects.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:2',
            'class_id' => 'required|exists:my_classes,id'
        ]);

        $data = $request->all();
        $data['school_id'] = $this->getSchoolId();
        
        Subject::create($data);
        return redirect()->back()->with('flash_success', 'Subject created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:2',
            'class_id' => 'required|exists:my_classes,id'
        ]);

        $subject = Subject::findOrFail($id);
        $this->checkSchoolAccess($subject->school_id);
        
        $subject->update($request->all());
        return redirect()->back()->with('flash_success', 'Subject updated successfully');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $this->checkSchoolAccess($subject->school_id);
        
        $subject->delete();
        return redirect()->back()->with('flash_success', 'Subject deleted successfully');
    }
} 