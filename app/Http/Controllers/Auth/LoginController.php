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
        // Fetch distinct provinces
        $provinces = DB::table('schools')
            ->select('province')
            ->distinct()
            ->get();

        // Fetch all schools grouped by province and district, ensuring no duplication
        $schoolsByDistrict = [];
        foreach ($provinces as $province) {
            $schoolsByDistrict[$province->province] = DB::table('schools')
                ->select('district')
                ->where('province', $province->province)
                ->distinct() // Fetch distinct districts for the province
                ->get()
                ->mapWithKeys(function ($district) use ($province) {
                    // Fetch unique schools for each district
                    $uniqueSchools = DB::table('schools')
                        ->select('id', 'school_code', 'school_name', 'district', 'province') // Only fetch necessary fields
                        ->where('province', $province->province)
                        ->where('district', $district->district)
                        ->groupBy('id', 'school_code', 'school_name', 'district', 'province') // Group by relevant fields
                        ->get();

                    return [$district->district => $uniqueSchools];
                });
        }
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
