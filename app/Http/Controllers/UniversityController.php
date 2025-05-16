<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::orderBy('name')->paginate(20);
        return view('universities.index', compact('universities'));
    }

    public function create()
    {
        return view('universities.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'university_code' => 'required|string|unique:universities',
            'type' => 'required|in:PUBLIC,PRIVATE',
            'district' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:universities',
            'phone_number' => 'nullable|string',
            'website' => 'nullable|url',
            'rector_name' => 'nullable|string',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'description' => 'nullable|string',
            'accreditation_status' => 'nullable|string',
            'faculties' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        University::create($request->all());

        return redirect()->route('universities.index')
            ->with('success', 'University created successfully');
    }

    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }

    public function edit(University $university)
    {
        return view('universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'university_code' => 'required|string|unique:universities,university_code,' . $university->id,
            'type' => 'required|in:PUBLIC,PRIVATE',
            'district' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:universities,email,' . $university->id,
            'phone_number' => 'nullable|string',
            'website' => 'nullable|url',
            'rector_name' => 'nullable|string',
            'established_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'description' => 'nullable|string',
            'accreditation_status' => 'nullable|string',
            'faculties' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $university->update($request->all());

        return redirect()->route('universities.index')
            ->with('success', 'University updated successfully');
    }

    public function destroy(University $university)
    {
        $university->delete();

        return redirect()->route('universities.index')
            ->with('success', 'University deleted successfully');
    }

    public function getByDistrict($district)
    {
        $universities = University::where('district', $district)
            ->orderBy('name')
            ->get();
        
        return response()->json($universities);
    }

    public function getByType($type)
    {
        $universities = University::where('type', strtoupper($type))
            ->orderBy('name')
            ->get();
        
        return response()->json($universities);
    }
} 