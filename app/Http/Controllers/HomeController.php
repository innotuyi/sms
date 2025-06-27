<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\University;
use App\Repositories\UserRepo;
use App\Models\MyClass;
use App\Models\Subject;
use App\Models\StudentRecord;
use App\Models\TimeTable;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SchoolBaseController;

class HomeController extends SchoolBaseController
{
    protected $user;
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }

    public function dashboard()
    {
        $user = auth()->user();

        $schoolId = $this->getSchoolId();
        if ($user->user_type !== 'super_admin') {
            $this->checkSchoolAccess($schoolId);
            $school = \App\Models\School::find($schoolId);
            if (!$school || !$school->is_active) {
                abort(403, 'Your school is not active or does not exist.');
            }
        } else {
            $school = null;
        }

        $d = [
            'total_students' => 0,
            'total_teachers' => 0,
            'total_parents' => 0,
            'total_accountants' => 0,
            'pass_rate' => 0,
            'ranking' => 'N/A',
            'student_capacity' => 0,
            'teacher_capacity' => 0,
            'classroom_count' => 0,
            'has_library' => false,
            'has_laboratory' => false,
            'has_sports_facility' => false,
            'school' => $school,
            'users' => collect(),
            'my_classes' => collect(),
            'my_subjects' => collect(),
            'my_students' => 0,
            'recent_marks' => collect(),
            'upcoming_exams' => collect(),
            'timetable' => collect(),
            'today_schedule' => collect()
        ];
        if ($user->user_type === 'super_admin') {
            // Super admin sees all data
            $d['users'] = $this->user->getAll();
            $usersArray = is_array($d['users']) ? $d['users'] : $d['users']->all();
        } else {
            // School admin/teacher/parent/etc. sees only their school's data
            $d['users'] = $this->user->getAllBySchool($schoolId);
            $usersArray = is_array($d['users']) ? $d['users'] : $d['users']->all();
        }
        $d['total_students'] = count(array_filter($usersArray, function($u) {
            return (isset($u->user_type) && trim(strtolower($u->user_type)) === 'student')
                || (is_array($u) && isset($u['user_type']) && trim(strtolower($u['user_type'])) === 'student');
        }));
        $d['total_teachers'] = count(array_filter($usersArray, function($u) {
            return (isset($u->user_type) && trim(strtolower($u->user_type)) === 'teacher')
                || (is_array($u) && isset($u['user_type']) && trim(strtolower($u['user_type'])) === 'teacher');
        }));
        $d['total_parents'] = count(array_filter($usersArray, function($u) {
            return (isset($u->user_type) && trim(strtolower($u->user_type)) === 'parent')
                || (is_array($u) && isset($u['user_type']) && trim(strtolower($u['user_type'])) === 'parent');
        }));
        $d['total_accountants'] = count(array_filter($usersArray, function($u) {
            return (isset($u->user_type) && trim(strtolower($u->user_type)) === 'accountant')
                || (is_array($u) && isset($u['user_type']) && trim(strtolower($u['user_type'])) === 'accountant');
        }));
        // Get school performance metrics
        $d['pass_rate'] = $school->pass_rate ?? 0;
        $d['ranking'] = $school->ranking ?? 'N/A';
        $d['student_capacity'] = $school->student_capacity ?? 0;
        $d['teacher_capacity'] = $school->teacher_capacity ?? 0;
        $d['classroom_count'] = $school->classroom_count ?? 0;
        $d['has_library'] = $school->has_library ?? false;
        $d['has_laboratory'] = $school->has_laboratory ?? false;
        $d['has_sports_facility'] = $school->has_sports_facility ?? false;

        // If user is a teacher, get their specific data
        if ($user->user_type === 'teacher') {
            $teacherId = $user->id;
            // Get teacher's classes
            $d['my_classes'] = \App\Models\MyClass::where('school_id', $schoolId)
                ->whereHas('subjects', function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId);
                })
                ->get();
            // Get teacher's subjects
            $d['my_subjects'] = \App\Models\Subject::where('school_id', $schoolId)
                ->where('teacher_id', $teacherId)
                ->get();
            // Get total students in teacher's classes
            $d['my_students'] = \App\Models\StudentRecord::where('school_id', $schoolId)
                ->whereIn('my_class_id', $d['my_classes']->pluck('id'))
                ->count();
            // Get recent marks (last 5)
            $subjectIds = \App\Models\Subject::where('school_id', $schoolId)
                ->where('teacher_id', $teacherId)
                ->pluck('id');
            $d['recent_marks'] = \App\Models\Mark::where('school_id', $schoolId)
                ->whereIn('subject_id', $subjectIds)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            // Get upcoming exams for teacher's subjects
            $d['upcoming_exams'] = \App\Models\Exam::where('school_id', $schoolId)
                ->whereIn('subject_id', $d['my_subjects']->pluck('id'))
                ->orderBy('year', 'desc')
                ->orderBy('name', 'asc')
                ->take(5)
                ->get();
            // Get teacher's timetable
            $d['timetable'] = \App\Models\TimeTable::where('school_id', $schoolId)
                ->whereIn('subject_id', $d['my_subjects']->pluck('id'))
                ->orderBy('day')
                ->get()
                ->groupBy('day');
            // Get today's schedule
            $today = strtolower(now()->format('l'));
            $d['today_schedule'] = \App\Models\TimeTable::where('school_id', $schoolId)
                ->whereIn('subject_id', $d['my_subjects']->pluck('id'))
                ->where('day', $today)
                ->get();
        }
        return view('pages.support_team.dashboard', $d);
    }
}
