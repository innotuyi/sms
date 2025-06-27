<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'school_name' => 'Demo School',
            'school_code' => 'DEMO001',
            'registration_number' => 'DEMO-2024-001',
            'email' => 'demo@school.com',
            'phone_number' => '+1234567890',
            'address' => '123 Demo Street, Demo City',
            'school_type' => 'Private',
            'school_level' => 'Secondary',
            'school_status' => 'active',
            'principal_name' => 'Demo Principal',
            'established_year' => 2024,
            'province' => 'Demo Province',
            'district' => 'Demo District',
            'sector' => 'Demo Sector',
            'grade' => 'A',
            'level' => 'Secondary',
            'trade' => 'General',
            'combination' => 'Science',
            'area' => 'Urban',
            'level_status' => 'Active'
        ]);
    }
}
