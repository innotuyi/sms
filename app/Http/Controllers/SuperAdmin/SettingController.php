<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Helpers\Qs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch all settings
        $settings = DB::select('SELECT * FROM settings');
        $schools = DB::select('SELECT * FROM schools'); // Fetch schools from the database
        $class_types = DB::select('SELECT * FROM class_types'); // Assuming class types are stored in this table

        // Process settings to flatMap
        $processed_settings = [];
        foreach ($settings as $setting) {
            $processed_settings[$setting->type] = $setting->description;
        }

        $data['class_types'] = $class_types;
        $data['schools'] = $schools; // Add schools to the data array
        $data['s'] = $processed_settings;

        return view('pages.super_admin.settings', $data);
    }



   
    public function test()
    {
        try {
            // Fetch all settings
            $settings = DB::select('SELECT * FROM settings');
            $class_types = DB::select('SELECT * FROM class_types'); // Assuming class types are stored in this table
            $schools = DB::select('SELECT * FROM schools'); // Fetch schools from the database
    
            // Process settings into a flat map
            $processed_settings = [];
            if ($settings) {
                foreach ($settings as $setting) {
                    $processed_settings[$setting->type] = $setting->description;
                }
            }
    
            // Prepare data for the view
            $data = [
                'class_types' => $class_types,
                's' => $processed_settings,  // This is passed as 's' in the view
                'schools' => $schools,       // Pass schools to the view
            ];
    
            // Return the view with the data
            return view('school.index', $data);
    
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return back()->withErrors(['error' => 'Something went wrong!']);
        }
    }
    


    public function update(Request $req)
    {
        // Remove CSRF and method spoofing fields
        $sets = $req->except('_token', '_method', 'logo', 'school_id');
        
        // Ensure 'school_id' is included in the update, if it exists
        $school_id = $req->input('school_id');
        if ($school_id) {
            // Example of inserting or updating the settings with school_id and type
            $types = ['lock_exam', 'some_other_type']; // Add other valid 'type' values here
            foreach ($types as $type) {
                DB::table('settings')->updateOrInsert(
                    ['school_id' => $school_id, 'type' => $type], // Add 'type' to the query
                    ['updated_at' => now()] // Ensure the updated_at timestamp is always updated
                );
            }
        }
    
        // Set lock_exam value, ensuring it's either 1 or 0
        $sets['lock_exam'] = $req->input('lock_exam') == 1 ? 1 : 0;
    
        // Update the other settings
        foreach ($sets as $key => $value) {
            DB::update(
                'UPDATE settings SET description = ?, updated_at = NOW() WHERE type = ?',
                [$value, $key]
            );
        }
    
        // If a logo is uploaded
        if ($req->hasFile('logo')) {
            $logo = $req->file('logo');
            $file_meta = Qs::getFileMetaData($logo);
            $file_meta['name'] = 'logo.' . $file_meta['ext'];
            $file_meta['path'] = $logo->storeAs(Qs::getPublicUploadPath(), $file_meta['name']);
            $logo_path = asset('storage/' . $file_meta['path']);
    
            DB::update(
                'UPDATE settings SET description = ?, updated_at = NOW() WHERE type = ?',
                [$logo_path, 'logo']
            );
        }
    
        return back()->with('flash_success', __('msg.update_ok'));
    }
    
    

    public function assignSetting(Request $req)
    {
        $req->validate([
            'school_id' => 'required|exists:schools,id',
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $school_id = $req->input('school_id');
        $type = $req->input('type');
        $description = $req->input('description');

        // Check if the setting already exists for the school
        $existing = DB::selectOne(
            'SELECT * FROM settings WHERE school_id = ? AND type = ?',
            [$school_id, $type]
        );

        if ($existing) {
            // Update the setting
            DB::update(
                'UPDATE settings SET description = ?, updated_at = NOW() WHERE school_id = ? AND type = ?',
                [$description, $school_id, $type]
            );
        } else {
            // Create a new setting
            DB::insert(
                'INSERT INTO settings (school_id, type, description, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())',
                [$school_id, $type, $description]
            );
        }

        return back()->with('flash_success', __('Setting assigned/updated successfully.'));
    }
}
