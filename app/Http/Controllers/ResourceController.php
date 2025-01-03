<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    
    // Display all digital resources
    public function index()
    {
        $resources = Resource::all();
        return view('ressource.index', compact('resources'));
    }

    // Show details of a single resource
    public function show($id)
    {
        $resource = Resource::findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    // Upload a new digital resource
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('resources', 'public');

        Resource::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('resources.index')->with('success', 'Resource uploaded successfully!');
    }

    // Delete a digital resource
    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);
        $resource->delete();
        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully!');
    }
}
