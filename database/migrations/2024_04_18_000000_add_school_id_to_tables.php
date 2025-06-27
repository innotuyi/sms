<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolIdToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add school_id to tables that need it
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

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (!Schema::hasColumn($tableName, 'school_id')) {
                        $table->unsignedBigInteger('school_id')->after('id')->nullable();
                    }
                });
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

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    if (Schema::hasColumn($tableName, 'school_id')) {
                        $table->dropColumn('school_id');
                    }
                });
            }
        }
    }
} 