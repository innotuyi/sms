<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;
use App\Models\School;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isSchoolAdmin()) {
            return redirect()->route('login');
        }

        // Verify school exists and is active
        $school = School::where('id', auth()->user()->school_id)
            ->where('is_active', true)
            ->first();

        if (!$school) {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your school account is not active or does not exist.',
            ]);
        }

        // Set school session data if not already set
        if (!session()->has('school_id')) {
            session(['school_id' => auth()->user()->school_id]);
            session(['school_name' => $school->school_name]);
        }

        return $next($request);
    }
}
