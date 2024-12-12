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
        $schools = School::all(); // Fetch all schools

        foreach ($sections as $section) {
            foreach ($schools as $school) { // Loop through schools
                User::factory()
                    ->has(
                        StudentRecord::factory()
                            ->state([
                                'section_id' => $section->id,
                                'my_class_id' => $section->my_class_id,
                                'school_id' => $school->id, // Assign school_id
                                'user_id' => function (User $user) {
                                    return ['user_id' => $user->id];
                                },
                            ]),
                        'student_record'
                    )
                    ->count($count)
                    ->create([
                        'user_type' => 'student',
                        'password' => Hash::make('student'),
                    ]);
            }
        }
    }

    protected function createStudentRecord()
    {
        $section = Section::first();
        $school = School::first(); // Fetch the first school

        $user = User::factory()->create([
            'name' => 'NZAYISENGA EMMANUEL',
            'user_type' => 'student',
            'username' => 'student',
            'password' => Hash::make('cj'),
            'email' => 'student@student.com',
        ]);

        StudentRecord::factory()->create([
            'my_class_id' => $section->my_class_id,
            'user_id' => $user->id,
            'section_id' => $section->id,
            'school_id' => $school->id, // Assign the school_id
        ]);
    }
}
