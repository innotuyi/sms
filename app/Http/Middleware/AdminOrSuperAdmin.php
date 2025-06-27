<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Qs;

class AdminOrSuperAdmin
{
    public function handle($request, Closure $next)
    {
        return (Auth::check() && (Qs::userIsSuperAdmin() || Qs::userIsAdmin()))
            ? $next($request)
            : redirect()->route('login');
    }
} 