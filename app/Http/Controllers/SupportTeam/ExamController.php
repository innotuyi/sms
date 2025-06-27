<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\Exam\ExamCreate;
use App\Http\Requests\Exam\ExamUpdate;
use App\Repositories\ExamRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    protected $exam;
    public function __construct(ExamRepo $exam)
    {
        $this->middleware('teamSAT', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->exam = $exam;
    }

    public function index()
    {
        $d['exams'] = $this->exam->getAllBySchool(Auth::user()->school_id);
        return view('pages.support_team.exams.index', $d);
    }

    public function store(ExamCreate $req)
    {
        $data = $req->only(['name', 'term']);
        $data['year'] = Qs::getSetting('current_session');
        $data['school_id'] = Auth::user()->school_id;

        $this->exam->create($data);
        return back()->with('flash_success', __('msg.store_ok'));
    }

    public function edit($id)
    {
        $d['ex'] = $this->exam->find($id);
        
        // Check if exam belongs to current school
        if ($d['ex']->school_id !== Auth::user()->school_id) {
            return redirect()->route('exams.index')->with('flash_danger', __('msg.denied'));
        }
        
        return view('pages.support_team.exams.edit', $d);
    }

    public function update(ExamUpdate $req, $id)
    {
        $exam = $this->exam->find($id);
        
        // Check if exam belongs to current school
        if ($exam->school_id !== Auth::user()->school_id) {
            return redirect()->route('exams.index')->with('flash_danger', __('msg.denied'));
        }
        
        $data = $req->only(['name', 'term']);
        $this->exam->update($id, $data);
        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function destroy($id)
    {
        $exam = $this->exam->find($id);
        
        // Check if exam belongs to current school
        if ($exam->school_id !== Auth::user()->school_id) {
            return redirect()->route('exams.index')->with('flash_danger', __('msg.denied'));
        }
        
        $this->exam->delete($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
