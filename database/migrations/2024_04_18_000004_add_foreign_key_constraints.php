<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddForeignKeyConstraints extends Migration
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
                // Check if foreign key constraint already exists
                $constraintName = $table . '_school_id_foreign';
                $constraintExists = DB::select("
                    SELECT COUNT(*) as count 
                    FROM information_schema.TABLE_CONSTRAINTS 
                    WHERE CONSTRAINT_SCHEMA = DATABASE()
                    AND TABLE_NAME = '$table'
                    AND CONSTRAINT_NAME = '$constraintName'
                ")[0]->count > 0;

                if (!$constraintExists) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->foreign('school_id')
                              ->references('id')
                              ->on('schools')
                              ->onDelete('cascade');
                    });
                }
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
                // Check if foreign key constraint exists before trying to drop it
                $constraintName = $table . '_school_id_foreign';
                $constraintExists = DB::select("
                    SELECT COUNT(*) as count 
                    FROM information_schema.TABLE_CONSTRAINTS 
                    WHERE CONSTRAINT_SCHEMA = DATABASE()
                    AND TABLE_NAME = '$table'
                    AND CONSTRAINT_NAME = '$constraintName'
                ")[0]->count > 0;

                if ($constraintExists) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->dropForeign(['school_id']);
                    });
                }
            }
        }
    }
} 