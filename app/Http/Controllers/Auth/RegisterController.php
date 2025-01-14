<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Disable the RegisterController.
     *
     * @return void
     */
    public function __construct()
    {
        abort(403, 'Registration functionality is disabled.');
    }
}
