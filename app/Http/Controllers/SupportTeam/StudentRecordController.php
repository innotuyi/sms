<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use App\Repositories\SchoolRepo;
use App\Repositories\SchooRepo;
use App\Services\RwandaLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentRecordController extends Controller
{
    protected $loc, $my_school, $my_class, $user, $student, $locationService;

   public function __construct(LocationRepo $loc, SchoolRepo $my_school, MyClassRepo $my_class, UserRepo $user, StudentRepo $student, RwandaLocationService $locationService)
   {
       $this->middleware('teamSA', ['only' => ['edit','update', 'reset_pass', 'create', 'store', 'graduated'] ]);
       $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->my_school = $my_school;
        $this->user = $user;
        $this->student = $student;
        $this->locationService = $locationService;
   }

    public function reset_pass($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        $data['password'] = Hash::make('student');
        $this->user->update($st_id, $data);
        return back()->with('flash_success', __('msg.p_reset'));
    }

    public function create()
    {

        
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['dorms'] = $this->student->getAllDorms();

        $provincesResponse = $this->locationService->fetchProvinces();
        // Extract the 'data' key containing provinces
        $data['provinces'] = $provincesResponse['data'] ?? [];

        //dd( $data['provinces']);

        // $data['provinces'] = $this->locationService->fetchProvinces(); 
        
        // dd( $data['provinces']);

        return view('pages.support_team.students.add', $data);
    }

      // Fetch districts based on province
      public function fetchDistricts(Request $request)
      {
  
          $districts = $this->locationService->fetchDistricts($request->province);


          return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => "All districts from province: {$request->province}",
            'data' => $districts,
        ]);
  
        

      }
  
      // Fetch sectors based on province and district
      public function fetchSectors(Request $request)
      {
          $sectors = $this->locationService->fetchSectors($request->province, $request->district);
  
          return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => "All sectors from district: {$request->district}",
            'data' => $sectors,
        ]);
        
      }
  
      // Fetch cells based on province, district, and sector
  
      public function fetchCells(Request $request)
      {
          $cells = $this->locationService->fetchCells($request->province, $request->district, $request->sector);
          return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => "All cells from sector: {$request->sector}",
            'data' => $cells,
        ]);
        
      }
  
      // Fetch villages based on province, district, sector, and cell
  
      public function fetchVillages(Request $request)
      {
  
          $villages = $this->locationService->fetchVillages($request->province, $request->district, $request->sector, $request->cell);
  
          return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => "All villages from cell: {$request->cell}",
            'data' => $villages,
        ]);
        
      }

      public function store(StudentRecordCreate $req)
      {
          $data =  $req->only(Qs::getUserRecord());
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
          $schoolCode = strtoupper($school->code);  // Assuming 'code' is the school code field in the schools table
      
          // Generate a unique admission number using school code and a random unique ID
          $uniqueId = mt_rand(1000, 99999);  // Random unique ID
          $data['username'] = strtoupper($schoolCode . '/' . $ct . '/' . $sr['year_admitted'] . '/' . $uniqueId);
      
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
          $sr['adm_no'] = $data['username'];  // Use the generated username as the admission number
          $sr['user_id'] = $user->id;
          $sr['session'] = Qs::getSetting('current_session');
          $this->student->createRecord($sr);  // Create Student
      
          return Qs::jsonStoreOk();  // Return success response
      }
      
    public function listByClass($class_id)
    {
        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        $data['students'] = $this->student->findStudentsByClass($class_id);
        $data['sections'] = $this->my_class->getClassSections($class_id);

        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.students.list', $data);
    }

    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();

        return view('pages.support_team.students.graduated', $data);
    }

    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = NULL;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();

        /* Prevent Other Students/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.students.show', $data);
    }

    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['dorms'] = $this->student->getAllDorms();
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.edit', $data);
    }

    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $d); // Update User Details

        $srec = $req->only(Qs::getStudentData());

        $this->student->updateRecord($sr_id, $srec); // Update St Rec

        /*** If Class/Section is Changed in Same Year, Delete Marks/ExamRecord of Previous Class/Section ****/
        Mk::deleteOldRecord($sr->user->id, $srec['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if(!$st_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student').$sr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }

}
