<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateSchoolIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'student_records',
            'staff_records',
            'subjects',
            'my_classes',
            'sections',
            'exams',
            'marks',
            'grades',
            'attendances',
            'time_tables',
            'dorms',
            'payments',
            'payment_records',
            'receipts',
            'expenses',
            'loans',
            'leaves',
            'payrolls',
            'past_papers',
            'resources',
            'books',
            'vehicles',
            'routes',
            'student__transports',
            'bus__attendances'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)
                    ->whereNull('school_id')
                    ->update(['school_id' => 3496]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to reverse this migration as it's a data update
    }
} 