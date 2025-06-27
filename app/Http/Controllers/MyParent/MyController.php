<?php

namespace App\Http\Controllers\MyParent;

use App\Http\Controllers\SchoolBaseController;
use App\Repositories\StudentRepo;
use Illuminate\Support\Facades\Auth;

class MyController extends SchoolBaseController
{
    protected $student;
    
    public function __construct(StudentRepo $student)
    {
        $this->student = $student;
    }

    public function children()
    {
        $data = $this->getSchoolData();
        $data['students'] = $this->student->getRecord(['my_parent_id' => Auth::user()->id])
            ->with(['my_class', 'section'])
            ->get();

        return view('pages.parent.children', $data);
    }
}