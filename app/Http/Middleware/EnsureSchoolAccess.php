<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\School;

class EnsureSchoolAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Super admin can access everything
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Get school_id from route parameter or request
        $schoolId = $request->route('school_id') ?? $request->input('school_id');

        // If no school_id specified, use user's school_id
        if (!$schoolId) {
            $request->merge(['school_id' => $user->school_id]);
            return $next($request);
        }

        // Check if user has access to the requested school
        if ($schoolId != $user->school_id) {
            abort(403, 'Unauthorized access to school data.');
        }

        return $next($request);
    }
} 