<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\StudentRecord;
use App\Models\School; // Import the School model
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStudentRecord();
        $this->createManyStudentRecords(3);
    }

    protected function createManyStudentRecords(int $count)
    {
        $sections = Section::all();
        $schools = School::all();
        $counter = 1;

        foreach ($sections as $section) {
            foreach ($schools as $school) {
                for ($i = 1; $i <= $count; $i++) {
                    $counter++;
                    $timestamp = time();
                    $user = User::factory()->create([
                        'user_type' => 'student',
                        'username' => 'student_' . $timestamp . '_' . $counter,
                        'password' => Hash::make('demo123'),
                        'school_id' => $school->id,
                        'code' => 'STU-' . $timestamp . '-' . $counter,
                    ]);

                    StudentRecord::factory()->create([
                        'section_id' => $section->id,
                        'my_class_id' => $section->my_class_id,
                        'school_id' => $school->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }

    protected function createStudentRecord()
    {
        $section = Section::first();
        $school = School::first();
        $timestamp = time();

        $user = User::factory()->create([
            'name' => 'Demo Student One',
            'user_type' => 'student',
            'username' => 'student_' . $timestamp . '_1',
            'password' => Hash::make('demo123'),
            'email' => 'student1@demo.school.com',
            'school_id' => $school->id,
            'code' => 'STU-' . $timestamp . '-1',
        ]);

        StudentRecord::factory()->create([
            'my_class_id' => $section->my_class_id,
            'user_id' => $user->id,
            'section_id' => $section->id,
            'school_id' => $school->id,
        ]);
    }
}
