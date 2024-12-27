<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Repositories\MyClassRepo;
use App\Repositories\SchoolRepo;
use App\Repositories\StudentRepo;
use App\Repositories\UserRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    protected $loc,$my_school, $my_class, $user, $student, $locationService;

    public function __construct(SchoolRepo $my_school, MyClassRepo $my_class, UserRepo $user,  StudentRepo $student,)
    {
        $this->middleware('teamSA', ['only' => ['edit','update', 'reset_pass', 'create', 'store', 'graduated'] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);
          $this->my_class = $my_class;
         $this->my_school = $my_school;
         $this->user = $user;
         $this->student = $student;
       
    }
    


    public function registerStudent(StudentRecordCreate $req)
    {      
        // $data =  $req->only(Qs::getUserRecord());

        $sr =  $req->only(Qs::getStudentData());
    
        // Retrieve the class type
        $ct = $this->my_class->findTypeByClass($req->my_class_id)->code;    
        // Prepare user data
        $data['user_type'] = 'student';
        $data['name'] = ucwords($req->name);
        $data['code'] = strtoupper(Str::random(10));
        $data['password'] = Hash::make('student');
        $data['photo'] = Qs::getDefaultUserImage();
        
        // Retrieve the school code
        $school = $this->my_school->find($req->school_id);  // Assuming you have access to the school model
        $schoolCode = strtoupper($school->school_code);  // Assuming 'code' is the school code field in the schools table
    
        // Generate a unique admission number using school code and a random unique ID
        $uniqueId = mt_rand(1000, 99999);  // Random unique ID
        $data['username'] = strtoupper($schoolCode . $sr['year_admitted'] . $uniqueId);
        $sr['adm_no'] = $data['username'];
    
        // Handle photo upload
        if ($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student') . $data['code'], $f['name']);
            $data['photo'] = asset('storage/' . $f['path']);
        }    
        // Create user
        $user = $this->user->create($data);
    
        // Create student record
        $sr['user_id'] = $user->id;
        $sr['session'] = Qs::getSetting('current_session');
        $this->student->createRecord($sr);  // Create Student
    
        return Qs::jsonStoreOk();  // Return success response
    }
}
