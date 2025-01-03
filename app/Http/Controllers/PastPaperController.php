<?php

namespace App\Http\Controllers;

use App\Models\PastPaper;
use Illuminate\Http\Request;

class PastPaperController extends Controller
{
    // Display a listing of the past papers
    public function index()
    {
        $pastPapers = PastPaper::all();
        return view('past_papers.index', compact('pastPapers'));
    }

    // Show the form for creating a new past paper
    public function create()
    {
        return view('past_papers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Ibizamini by’abalimu,Ibizamini bya Leta',
            'academic_year' => 'required|string',
            'subject' => 'required|string',
            'level' => 'required|in:Primary,O\'level,A\'level',
            'document' => 'required|file|mimes:pdf|max:2048', // Ensure the file is a valid PDF
        ]);
    
        // Handle file upload
        if ($request->hasFile('document')) { // Use 'document' here as per your validation rule
            $file = $request->file('document'); // Use 'document'
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/past_papers', $fileName); // Store the file in the 'public/past_papers' directory
        }
    
        // Save the data in the database
        PastPaper::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'academic_year' => $validated['academic_year'],
            'subject' => $validated['subject'],
            'level' => $validated['level'],
            'file_name' => $fileName ?? null, // Use null if the file is not uploaded (unlikely with validation)
        ]);
    
        return redirect()->route('past_papers.index')->with('success', 'Past paper uploaded successfully!');
    }
    

    // Display the specified past paper
    public function show($id)
    {
        $pastPaper = PastPaper::findOrFail($id);
        return view('past_papers.show', compact('pastPaper'));
    }

    // Show the form for editing the specified past paper
    public function edit($id)
    {
        $pastPaper = PastPaper::findOrFail($id);
        return view('past_papers.edit', compact('pastPaper'));
    }

    // Update the specified past paper in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Ibizamini by’abalimu,Ibizamini bya Leta',
            'file_path' => 'required|string|max:255',
            'academic_year' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'level' => 'required|in:Primary,O-level,A-level',
        ]);

        $pastPaper = PastPaper::findOrFail($id);
        $pastPaper->update($validatedData);

        return redirect()->route('past_papers.index')->with('success', 'Past Paper updated successfully!');
    }

    // Remove the specified past paper from storage
    public function destroy($id)
    {
        $pastPaper = PastPaper::findOrFail($id);
        $pastPaper->delete();

        return redirect()->route('past_papers.index')->with('success', 'Past Paper deleted successfully!');
    }
}