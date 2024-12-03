<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => 'Booarding', 'code' => 'C'],
            ['name' => 'Tvet', 'code' => 'PN'],
            ['name' => 'Nursery', 'code' => 'N'],
            ['name' => 'Primary', 'code' => 'P'],
            ['name' => 'Ordinal level', 'code' => 'J'],
            ['name' => 'Advanced Level', 'code' => 'S'],
        ];

        DB::table('class_types')->insert($data);

    }
}
