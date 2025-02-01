<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    /**
     * Display a listing of the schools.
     */
    public function index()
    {
        $schools = School::all();

    return view('school.index', compact('schools'));
    }

    /**
     * Store a newly created school in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'school_code' => 'nullable|string|unique:schools,school_code|max:10',
            'school_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:schools,email|max:255',
            'principal_name' => 'nullable|string|max:255',
            'province' => 'nullable|string|in:Kigali City,Southern Province,Western Province,Northern Province,Eastern Province',  // Add valid provinces here
            'district' => 'nullable|string|max:255', // Can be dynamically checked based on the province
            'established_year' => 'nullable|integer|digits:4',
            'school_type' => 'nullable|string|max:50', // Public or Private
            'registration_number' => 'nullable|string|max:100',
        ]);

        // Set default value for school_code if not provided
        if (empty($data['school_code'])) {
            $lastSchool = School::latest('id')->first();
            $lastCode = $lastSchool ? (int)substr($lastSchool->school_code, 3) : 0;
            $data['school_code'] = 'SCH' . str_pad($lastCode + 1, 2, '0', STR_PAD_LEFT);
        }

        $school = School::create($data);

        return redirect()->route('school.index');

    }

    public function show($id)
    {


                // Fetch distinct provinces
                $provinces = DB::table('schools')
                ->select('province')
                ->distinct()
                ->get();
        
            // Fetch all schools grouped by province → district → sector
            $schoolsBySector = [];
            foreach ($provinces as $province) {
                // Get all districts in the province
                $districts = DB::table('schools')
                    ->select('district')
                    ->where('province', $province->province)
                    ->distinct()
                    ->get();
        
                foreach ($districts as $district) {
                    // Get all sectors in the district
                    $sectors = DB::table('schools')
                        ->select('sector')
                        ->where('province', $province->province)
                        ->where('district', $district->district)
                        ->distinct()
                        ->get();
        
                    foreach ($sectors as $sector) {
                        // Fetch all schools in the sector
                        $schools = DB::table('schools')
                            ->select('id', 'school_name')
                            ->where('province', $province->province)
                            ->where('district', $district->district)
                            ->where('sector', $sector->sector)
                            ->get();
        
                        // Store data in an associative array
                        $schoolsBySector[$province->province][$district->district][$sector->sector] = $schools;
                    }
                }
            }


        // Fetch school details
        $school = DB::table('schools')->find($id);

        if (!$school) {
            abort(404, 'School not found');
        }

        return view('school.show', compact(['school', 'provinces', 'schoolsBySector']));
    }

    public function showByDistrict($province, $district)
    {
        // Fetch all schools in the specified district
        $schools = DB::table('schools')
            ->where('province', $province)
            ->where('district', $district)
            ->get();

        if ($schools->isEmpty()) {
            abort(404, 'No schools found in this district');
        }

        return view('districts.show', compact('province', 'district', 'schools'));
    }
    /**
     * Update the specified school in storage.
     */
    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);

        $data = $request->validate([
            'school_code' => 'nullable|string|unique:schools,school_code,' . $id . '|max:10',
            'school_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:schools,email,' . $id . '|max:255',
            'principal_name' => 'nullable|string|max:255',
            'province' => 'nullable|string|in:Kigali City,Southern Province,Western Province,Northern Province,Eastern Province',  // Add valid provinces here
            'district' => 'nullable|string|max:255', // Can be dynamically checked based on the province
            'established_year' => 'nullable|integer|digits:4',
            'school_type' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:100',
        ]);

        $school->update($data);

        return response()->json($school);
    }

    /**
     * Remove the specified school from storage.
     */
    public function destroy($id)
    {
        try {
            // Check if the school exists in the database
            $school = School::findOrFail($id);
    
            // Check if the school is referenced in the 'settings' table (or any other related table)
            $isReferencedInSettings = \DB::table('settings') // assuming 'settings' is the table name
                ->where('school_id', $id) // assuming 'school_id' is the foreign key in the settings table
                ->exists();
    
            if ($isReferencedInSettings) {
                // If the school is referenced in the 'settings' table, return an error message
                return redirect()->route('school.index')->with('error', 'School cannot be deleted because it is referenced in the settings.');
            }
    
            // Delete the school if no references exist in the 'settings' table
            $school->delete();
    
            return redirect()->route('school.index')->with('success', 'School deleted successfully.');
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If the school with the given ID is not found
            return redirect()->route('school.index')->with('error', 'School not found.');
        
        } catch (\Illuminate\Database\QueryException $e) {
            // If there is a database connection error (network issue, etc.)
            return redirect()->route('school.index')->with('error', 'A network error occurred. Please try again later.');
        
        } catch (\Exception $e) {
            // Catch any other general exceptions
            return redirect()->route('school.index')->with('error', 'An error occurred while deleting the school.');
        }
    }
    
}

