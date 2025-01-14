<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Disable the LoginController.
     *
     * @return void
     */

    public function login()
    {
        return view('auth.login');
    }
}
