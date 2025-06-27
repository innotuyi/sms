<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class PublicSchoolController extends Controller
{
    public function filter(Request $request)
    {
        \Log::info('PublicSchoolController@filter method was hit', [
            'request_data' => $request->all(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'headers' => $request->headers->all()
        ]);

        $query = School::query();
    
        if ($request->has('province') && $request->province) {
            $query->where('province', 'like', '%' . trim($request->province) . '%');
        }
    
        if ($request->has('district') && $request->district) {
            $query->where('district', 'like', '%' . trim($request->district) . '%');
        }
    
        if ($request->has('sector') && $request->sector) {
            $query->where('sector', 'like', '%' . trim($request->sector) . '%');
        }
        if ($request->has('level_status') && $request->level_status) {
            $query->where('level_status', $request->level_status);
        }
    
        if ($request->has('combination') && $request->combination) {
            $query->where('combination', 'like', '%' . trim($request->combination) . '%');
        }
    
        $myschools = $query->select([
            'id',
            'school_code',
            'school_name',
            'province',
            'district',
            'sector',
            'combination',
            'level_status',
            'school_level',
            'school_status'
        ])->get();
    
        // Fetch distinct provinces
        $provinces = DB::table('schools')
            ->select('province')
            ->distinct()
            ->get();
    
        // Fetch all schools grouped by province → district → sector
        $schoolsBySector = [];
        foreach ($provinces as $province) {
            $districts = DB::table('schools')
                ->select('district')
                ->where('province', $province->province)
                ->distinct()
                ->get();
    
            foreach ($districts as $district) {
                $sectors = DB::table('schools')
                    ->select('sector')
                    ->where('province', $province->province)
                    ->where('district', $district->district)
                    ->distinct()
                    ->get();
    
                foreach ($sectors as $sector) {
                    $schools = DB::table('schools')
                        ->select('id', 'school_name', 'school_code')
                        ->where('province', $province->province)
                        ->where('district', $district->district)
                        ->where('sector', $sector->sector)
                        ->get();
    
                    $schoolsBySector[$province->province][$district->district][$sector->sector] = $schools;
                }
            }
        }

        // Fetch universities
        $universities = University::orderBy('name')
            ->select('id', 'name', 'type', 'district', 'address', 'website', 'phone_number', 'accreditation_status')
            ->get();
    
        return view('school.filtered', compact('schools', 'provinces', 'schoolsBySector', "myschools", 'universities'));
    }

    public function show($schoolCode)
    {
        // Fetch distinct provinces
        $provinces = DB::table('schools')
            ->select('province')
            ->distinct()
            ->get();

        // Fetch all schools grouped by province → district → sector
        $schoolsBySector = [];
        foreach ($provinces as $province) {
            $districts = DB::table('schools')
                ->select('district')
                ->where('province', $province->province)
                ->distinct()
                ->get();

            foreach ($districts as $district) {
                $sectors = DB::table('schools')
                    ->select('sector')
                    ->where('province', $province->province)
                    ->where('district', $district->district)
                    ->distinct()
                    ->get();

                foreach ($sectors as $sector) {
                    $schools = DB::table('schools')
                        ->select('id','school_code', 'school_name')
                        ->where('province', $province->province)
                        ->where('district', $district->district)
                        ->where('sector', $sector->sector)
                        ->get();

                    $schoolsBySector[$province->province][$district->district][$sector->sector] = $schools;
                }
            }
        }

        // Fetch school details
        $groups = DB::table('schools')
            ->where('school_code', $schoolCode)
            ->get()
            ->groupBy('school_code')
            ->map(function ($items) {
                $first = $items->first();

                return [
                    'id' => $first->id,
                    'school_name' => $first->school_name,
                    'school_status' => $first->school_status,
                    'school_level' => $first->school_level,
                    'province' => $first->province,
                    'district' => $first->district,
                    'sector' => $first->sector,
                    'options' => $items->map(function ($item) {
                        return [
                            'grade' => $item->grade,
                            'level' => $item->level,
                            'combination' => $item->combination,
                        ];
                    })->values(),
                ];
            });

        // Fetch universities
        $universities = University::orderBy('name')
            ->select('id', 'name', 'type', 'district', 'address', 'website', 'phone_number', 'accreditation_status')
            ->get();

        return view('school.show', compact(['groups', 'schoolCode', 'provinces', 'schoolsBySector'], 'universities'));
    }

    public function nonexistentMethod()
    {
        return 'This is a simple test!';
    }

    public function publicTest()
    {
        return 'This is a public controller test!';
    }
} 