<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use App\Models\University;
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
    
        // Fetch all schools grouped by province → district → sector
        $schoolsBySector = [];
        foreach ($provinces as $province) {
            // Get all districts in the province
            $districts = DB::table('schools')
                ->select('district')
                ->where('province', $province->province)
                ->distinct()
                ->get();
    
            foreach ($districts as $district) {
                // Get all sectors in the district
                $sectors = DB::table('schools')
                    ->select('sector')
                    ->where('province', $province->province)
                    ->where('district', $district->district)
                    ->distinct()
                    ->get();
    
                foreach ($sectors as $sector) {
                    // Fetch all schools in the sector
                    $schools = DB::table('schools')
                        ->select('id', 'school_name','school_code')
                        ->where('province', $province->province)
                        ->where('district', $district->district)
                        ->where('sector', $sector->sector)
                        ->get();
    
                    // Store data in an associative array
                    $schoolsBySector[$province->province][$district->district][$sector->sector] = $schools;
                }
            }
        }

        // Fetch universities
        $universities = University::orderBy('name')
            ->select('id', 'name', 'type', 'district', 'address', 'website', 'phone_number', 'accreditation_status')
            ->get();
    
        return view('auth.login', compact('provinces', 'schoolsBySector', 'universities'));
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


    public function auth() {


        $provinces = DB::table('schools')
        ->select('province')
        ->distinct()
        ->get();

       // Fetch distinct provinces
       $provinces = DB::table('schools')
       ->select('province')
       ->distinct()
       ->get();

   // Fetch all schools grouped by province → district → sector
   $schoolsBySector = [];
   foreach ($provinces as $province) {
       // Get all districts in the province
       $districts = DB::table('schools')
           ->select('district')
           ->where('province', $province->province)
           ->distinct()
           ->get();

       foreach ($districts as $district) {
           // Get all sectors in the district
           $sectors = DB::table('schools')
               ->select('sector')
               ->where('province', $province->province)
               ->where('district', $district->district)
               ->distinct()
               ->get();

           foreach ($sectors as $sector) {
               // Fetch all schools in the sector
               $schools = DB::table('schools')
                   ->select('id', 'school_name','school_code')
                   ->where('province', $province->province)
                   ->where('district', $district->district)
                   ->where('sector', $sector->sector)
                   ->get();

               // Store data in an associative array
               $schoolsBySector[$province->province][$district->district][$sector->sector] = $schools;
           }
       }


        // Fetch universities
        $universities = University::orderBy('name')
            ->select('id', 'name', 'type', 'district', 'address', 'website', 'phone_number', 'accreditation_status')
            ->get();
   }

   return view('login', compact('provinces', 'schoolsBySector', 'universities'));
    }
}
