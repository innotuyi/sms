<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all(); // Fetch all routes
        return view('routing.index', compact('routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
        ]);

        Route::create($request->all());

        return redirect()->route('routing.index')->with('success', 'Route added successfully.');
    }

    public function edit($id)
    {
        $route = Route::findOrFail($id);
        return view('routing.edit', compact('route'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
        ]);

        $route = Route::findOrFail($id);
        $route->update($request->all());

        return redirect()->route('routing.index')->with('success', 'Route updated successfully.');
    }

    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();

        return redirect()->route('routing.index')->with('success', 'Route deleted successfully.');
    }
}
