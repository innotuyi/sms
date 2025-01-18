<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Fetch provinces and their associated districts
        $provinces = DB::table('schools')
            ->select('province', 'district')
            ->groupBy('province', 'district')
            ->get();
        
        // Fetch all schools for each district
        $schoolsByDistrict = [];
        foreach ($provinces as $province) {
            $schoolsByDistrict[$province->province][$province->district] = DB::table('schools')
                ->where('province', $province->province)
                ->where('district', $province->district)
                ->get();
        }
        
        // Pass the data to the view
        return view('auth.login', compact('provinces', 'schoolsByDistrict'));
    }
    
    
    
    

    /**
     * Handle login submissions.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log in using the provided credentials
        $credentials = [
            filter_var($request->identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $request->identity,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            // Authentication passed
            return redirect()->intended('/dashboard')->with('status', 'Welcome back!');
        }

        // Authentication failed
        return back()->withErrors(['identity' => 'Invalid login ID or password.'])->withInput($request->only('identity', 'remember'));
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'You have been logged out.');
    }

}
