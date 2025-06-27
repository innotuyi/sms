<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixOrphanedSchoolIds extends Migration
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
        $defaultSchoolId = 3496;
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                // Set school_id to 3496 where it is NULL
                DB::table($table)
                    ->whereNull('school_id')
                    ->update(['school_id' => $defaultSchoolId]);
                // Set school_id to 3496 where it does not exist in schools table
                DB::statement("
                    UPDATE `$table` t
                    LEFT JOIN schools s ON t.school_id = s.id
                    SET t.school_id = $defaultSchoolId
                    WHERE t.school_id IS NOT NULL AND s.id IS NULL
                ");
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