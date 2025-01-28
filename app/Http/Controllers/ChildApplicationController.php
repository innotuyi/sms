<?php

namespace App\Http\Controllers;

use App\Models\ChildApplication;
use Illuminate\Http\Request;
use Validator;

class ChildApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = ChildApplication::all();
        return view('child.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('child.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define the validation rules
        $validator = Validator::make($request->all(), [
            'child_full_name' => 'required|string|max:255',
            'category' => 'required|string',
            'option' => 'nullable|string',
            'marks_percentage' => 'required|numeric|min:0|max:100',
            'marks_attachment' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'parent_full_name' => 'required|string|max:255',
            'parent_email' => 'required|email|max:255',
            'parent_phone' => 'required|string|max:15',
        ]);


    
        // Check if the validation failed
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


    
        // Handle file upload
        $validatedData = $validator->validated();
    
        if ($request->hasFile('marks_attachment')) {
            $path = $request->file('marks_attachment')->store('attachments', 'public');
            $validatedData['marks_attachment'] = $path;
        }

    
        // Create the child application
        ChildApplication::create($validatedData);
    
        return response()->json(['message' => 'Application submitted successfully!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildApplication $childApplication)
    {
        return view('child.show', compact('childApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildApplication $childApplication)
    {
        return view('child.edit', compact('childApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChildApplication $childApplication)
    {
        $validatedData = $request->validate([
            'child_full_name' => 'required|string|max:255',
            'category' => 'required|string',
            'option' => 'nullable|string',
            'marks_percentage' => 'required|numeric|min:0|max:100',
            'marks_attachment' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'parent_full_name' => 'required|string|max:255',
            'parent_email' => 'required|email|max:255',
            'parent_phone' => 'required|string|max:15',
        ]);

        // Handle file upload
        if ($request->hasFile('marks_attachment')) {
            $path = $request->file('marks_attachment')->store('attachments', 'public');
            $validatedData['marks_attachment'] = $path;
        }

        $childApplication->update($validatedData);

        return redirect()->route('child.index')->with('success', 'Application updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildApplication $childApplication)
    {
        if ($childApplication->marks_attachment) {
            \Storage::disk('public')->delete($childApplication->marks_attachment);
        }

        $childApplication->delete();

        return redirect()->route('child.index')->with('success', 'Application deleted successfully!');
    }
}
