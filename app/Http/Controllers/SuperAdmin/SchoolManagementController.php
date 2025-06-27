<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolManagementController extends Controller
{
    public function index()
    {
        $schools = School::with('admin')->get();
        return view('pages.super_admin.schools.index', compact('schools'));
    }

    public function create()
    {
        return view('pages.super_admin.schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_code' => 'required|string|max:20|unique:schools',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:schools',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users',
            'admin_phone' => 'required|string|max:20',
        ]);

        // Create School
        $school = School::create([
            'school_name' => $request->name,
            'school_code' => strtoupper($request->school_code),
            'address' => $request->address,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'is_active' => true
        ]);

        // Create School Admin
        $admin = User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'phone' => $request->admin_phone,
            'password' => Hash::make('admin123'), // Default password
            'user_type' => 'admin',
            'school_id' => $school->id,
            'code' => strtoupper(Str::random(10)),
            'username' => strtolower($request->admin_email)
        ]);

        return redirect()->route('super_admin.schools.index')
            ->with('flash_success', 'School and admin created successfully');
    }

    public function edit($id)
    {
        // Debug information
        // dd([
        //     'Method' => 'edit',
        //     'ID Parameter' => $id,
        //     'ID Type' => gettype($id),
        //     'Request URL' => request()->url(),
        //     'Request Method' => request()->method(),
        //     'Route Name' => request()->route()->getName(),
        //     'All Route Parameters' => request()->route()->parameters(),
        // ]);

        $school = School::with('admin')->findOrFail($id);
        return view('pages.super_admin.schools.edit', compact('school'));
    }

    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'school_code' => 'required|string|max:20|unique:schools,school_code,' . $id,
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:schools,email,' . $id,
            'is_active' => 'boolean'
        ]);

        $school->update([
            'school_name' => $request->name,
            'school_code' => strtoupper($request->school_code),
            'address' => $request->address,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('super_admin.schools.index')
            ->with('flash_success', 'School updated successfully');
    }

    public function toggleStatus($id)
    {
        $school = School::findOrFail($id);
        $school->is_active = !$school->is_active;
        $school->save();

        $status = $school->is_active ? 'activated' : 'deactivated';
        return redirect()->route('super_admin.schools.index')
            ->with('flash_success', "School {$status} successfully");
    }

    public function resetAdminPassword($id)
    {
        $admin = User::where('school_id', $id)
            ->where('user_type', 'admin')
            ->firstOrFail();

        $admin->password = Hash::make('admin123');
        $admin->save();

        return redirect()->route('super_admin.schools.index')
            ->with('flash_success', 'Admin password reset successfully');
    }

    public function addAdmin(Request $request, $id)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users,email',
            'admin_phone' => 'required|string|max:20',
            'username' => 'nullable|string|max:255|unique:users,username',
        ]);

        // Remove old admin if exists
        User::where('school_id', $id)->where('user_type', 'admin')->delete();

        // Create new admin
        User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'phone' => $request->admin_phone,
            'password' => Hash::make('admin123'),
            'user_type' => 'admin',
            'school_id' => $id,
            'code' => strtoupper(Str::random(10)),
            'username' => $request->username ? $request->username : strtolower($request->admin_email)
        ]);

        return redirect()->back()->with('flash_success', 'School admin added/changed successfully!');
    }

    public function listAdmins()
    {
        $admins = User::with('school')->where('user_type', 'admin')->get();
        return view('pages.super_admin.schools.admins', compact('admins'));
    }
} 