<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;

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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check user type and redirect accordingly
            switch ($user->user_type) {
                case 'admin':
                    // Verify school exists and is active
                    $school = School::where('id', $user->school_id)
                        ->where('is_active', true)
                        ->first();

                    if (!$school) {
                        Auth::logout();
                        return back()->withErrors([
                            'username' => 'Your school account is not active or does not exist.',
                        ]);
                    }

                    // Set school session data
                    session(['school_id' => $user->school_id]);
                    session(['school_name' => $school->school_name]);
                    break;

                case 'super_admin':
                    // Super admin can access everything
                    break;

                case 'teacher':
                case 'student':
                case 'parent':
                case 'accountant':
                    // Verify school exists and is active
                    $school = School::where('id', $user->school_id)
                        ->where('is_active', true)
                        ->first();

                    if (!$school) {
                        Auth::logout();
                        return back()->withErrors([
                            'username' => 'Your school account is not active or does not exist.',
                        ]);
                    }

                    // Set school session data
                    session(['school_id' => $user->school_id]);
                    session(['school_name' => $school->school_name]);
                    break;
            }
            
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function auth() {
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

        return view('login', compact('provinces', 'schoolsBySector', 'universities'));
    }
}
