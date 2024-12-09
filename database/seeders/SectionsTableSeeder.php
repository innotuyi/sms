<?php
namespace Database\Seeders;

use App\Models\MyClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();
        $c = MyClass::pluck('id')->all();

        $data = [
            ['name' => 'N1', 'my_class_id' => $c[0], 'active' => 1],
            ['name' => 'N2', 'my_class_id' => $c[1], 'active' => 0],
            ['name' => 'A', 'my_class_id' => $c[3], 'active' => 1],
            ['name' => 'B', 'my_class_id' => $c[4], 'active' => 0],
            ['name' => 'C', 'my_class_id' => $c[5], 'active' => 1],
            ['name' => 'D', 'my_class_id' => $c[6], 'active' => 1],
            ['name' => 'E', 'my_class_id' => $c[7], 'active' => 1],
            ['name' => 'F', 'my_class_id' => $c[8], 'active' => 1],
            ['name' => 'G', 'my_class_id' => $c[9], 'active' => 1],
            ['name' => 'H', 'my_class_id' => $c[8], 'active' => 1],
            ['name' => 'I', 'my_class_id' => $c[4], 'active' => 1],
            ['name' => 'F', 'my_class_id' => $c[9], 'active' => 1],
        ];

        DB::table('sections')->insert($data);
    }
}
