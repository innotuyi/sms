<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixAllSchoolIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'subjects',
            'student_records',
            'staff_records',
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
                // First, update any NULL values
                DB::table($table)
                    ->whereNull('school_id')
                    ->update(['school_id' => 3496]);

                // Then, update any invalid school_ids
                DB::statement("
                    UPDATE `$table` t
                    LEFT JOIN schools s ON t.school_id = s.id
                    SET t.school_id = 3496
                    WHERE t.school_id IS NOT NULL 
                    AND s.id IS NULL
                ");
            }
        }

        if (Schema::hasTable('subjects')) {
            DB::statement("UPDATE subjects SET school_id = 3496 WHERE school_id IS NULL;");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to reverse this migration as it's a data fix
    }
} 