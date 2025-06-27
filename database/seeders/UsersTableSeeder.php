<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $this->createDemoUsers();
    }

    protected function createDemoUsers()
    {
        $password = Hash::make('demo123'); // Demo password

        $d = [
            [
                'name' => 'Super Admin',
                'email' => 'cj@cj.com',
                'username' => 'cj',
                'password' => Hash::make('cj'),
                'user_type' => 'super_admin',
                'code' => 'SUPER-ADMIN-001',
                'school_id' => null,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Demo Admin',
                'email' => 'admin@demo.school.com',
                'username' => 'admin',
                'password' => $password,
                'user_type' => 'admin',
                'code' => 'DEMO-ADMIN-001',
                'school_id' => 1,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Demo Teacher',
                'email' => 'teacher@demo.school.com',
                'username' => 'teacher',
                'password' => $password,
                'user_type' => 'teacher',
                'code' => 'DEMO-TEACH-001',
                'school_id' => 1,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Demo Parent',
                'email' => 'parent@demo.school.com',
                'username' => 'parent',
                'password' => $password,
                'user_type' => 'parent',
                'code' => 'DEMO-PARENT-001',
                'school_id' => 1,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Demo Accountant',
                'email' => 'accountant@demo.school.com',
                'username' => 'accountant',
                'password' => $password,
                'user_type' => 'accountant',
                'code' => 'DEMO-ACC-001',
                'school_id' => 1,
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Demo Student',
                'email' => 'student@demo.school.com',
                'username' => 'student',
                'password' => $password,
                'user_type' => 'student',
                'code' => 'DEMO-STUD-001',
                'school_id' => 1,
                'remember_token' => Str::random(10),
            ]
        ];
        DB::table('users')->insert($d);
    }
}
