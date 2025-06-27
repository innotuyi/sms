<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\SchoolBaseController;
use App\Models\MyClass;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassController extends SchoolBaseController
{
    public function index()
    {
        $data = $this->getSchoolData();
        $data['classes'] = $this->scopeToSchool(MyClass::query())
            ->with('sections')
            ->get();
        return view('pages.academic.classes.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'section_id' => 'required|exists:sections,id'
        ]);

        $data = $request->all();
        $data['school_id'] = $this->getSchoolId();
        
        MyClass::create($data);
        return redirect()->back()->with('flash_success', 'Class created successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'section_id' => 'required|exists:sections,id'
        ]);

        $class = MyClass::findOrFail($id);
        $this->checkSchoolAccess($class->school_id);
        
        $class->update($request->all());
        return redirect()->back()->with('flash_success', 'Class updated successfully');
    }

    public function destroy($id)
    {
        $class = MyClass::findOrFail($id);
        $this->checkSchoolAccess($class->school_id);
        
        $class->delete();
        return redirect()->back()->with('flash_success', 'Class deleted successfully');
    }
} 