<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPerformanceIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Helper function to check if index exists
        $indexExists = function($table, $index) {
            $conn = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = collect($conn->listTableIndexes($table));
            return $indexes->has($index);
        };

        // Helper function to check if column exists
        $columnExists = function($table, $column) {
            return Schema::hasColumn($table, $column);
        };

        // Add indexes to schools table if they don't exist
        if ($columnExists('schools', 'school_code') && !$indexExists('schools', 'schools_school_code_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index('school_code');
            });
        }

        if ($columnExists('schools', 'school_name') && !$indexExists('schools', 'schools_school_name_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index('school_name');
            });
        }

        if ($columnExists('schools', 'province') && !$indexExists('schools', 'schools_province_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index('province');
            });
        }

        if ($columnExists('schools', 'district') && !$indexExists('schools', 'schools_district_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index('district');
            });
        }

        if ($columnExists('schools', 'sector') && !$indexExists('schools', 'schools_sector_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index('sector');
            });
        }

        if ($columnExists('schools', 'province') && $columnExists('schools', 'district') && $columnExists('schools', 'sector') 
            && !$indexExists('schools', 'schools_province_district_sector_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->index(['province', 'district', 'sector']);
            });
        }

        // Add indexes to student_records table if they don't exist
        if ($columnExists('student_records', 'admission_number') && !$indexExists('student_records', 'student_records_admission_number_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->index('admission_number');
            });
        }

        if ($columnExists('student_records', 'first_name') && !$indexExists('student_records', 'student_records_first_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->index('first_name');
            });
        }

        if ($columnExists('student_records', 'last_name') && !$indexExists('student_records', 'student_records_last_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->index('last_name');
            });
        }

        if ($columnExists('student_records', 'first_name') && $columnExists('student_records', 'last_name') 
            && !$indexExists('student_records', 'student_records_first_name_last_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->index(['first_name', 'last_name']);
            });
        }

        // Add indexes to staff_records table if they don't exist
        if ($columnExists('staff_records', 'staff_id') && !$indexExists('staff_records', 'staff_records_staff_id_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->index('staff_id');
            });
        }

        if ($columnExists('staff_records', 'first_name') && !$indexExists('staff_records', 'staff_records_first_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->index('first_name');
            });
        }

        if ($columnExists('staff_records', 'last_name') && !$indexExists('staff_records', 'staff_records_last_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->index('last_name');
            });
        }

        if ($columnExists('staff_records', 'first_name') && $columnExists('staff_records', 'last_name') 
            && !$indexExists('staff_records', 'staff_records_first_name_last_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->index(['first_name', 'last_name']);
            });
        }

        // Add indexes to payments table if they don't exist
        if ($columnExists('payments', 'payment_date') && !$indexExists('payments', 'payments_payment_date_index')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->index('payment_date');
            });
        }

        if ($columnExists('payments', 'payment_status') && !$indexExists('payments', 'payments_payment_status_index')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->index('payment_status');
            });
        }

        // Add indexes to attendances table if they don't exist
        if ($columnExists('attendances', 'date') && !$indexExists('attendances', 'attendances_date_index')) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->index('date');
            });
        }

        if ($columnExists('attendances', 'status') && !$indexExists('attendances', 'attendances_status_index')) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Helper function to check if index exists
        $indexExists = function($table, $index) {
            $conn = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = collect($conn->listTableIndexes($table));
            return $indexes->has($index);
        };

        // Remove indexes from schools table if they exist
        if ($indexExists('schools', 'schools_school_code_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['school_code']);
            });
        }

        if ($indexExists('schools', 'schools_school_name_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['school_name']);
            });
        }

        if ($indexExists('schools', 'schools_province_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['province']);
            });
        }

        if ($indexExists('schools', 'schools_district_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['district']);
            });
        }

        if ($indexExists('schools', 'schools_sector_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['sector']);
            });
        }

        if ($indexExists('schools', 'schools_province_district_sector_index')) {
            Schema::table('schools', function (Blueprint $table) {
                $table->dropIndex(['province', 'district', 'sector']);
            });
        }

        // Remove indexes from student_records table if they exist
        if ($indexExists('student_records', 'student_records_admission_number_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->dropIndex(['admission_number']);
            });
        }

        if ($indexExists('student_records', 'student_records_first_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->dropIndex(['first_name']);
            });
        }

        if ($indexExists('student_records', 'student_records_last_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->dropIndex(['last_name']);
            });
        }

        if ($indexExists('student_records', 'student_records_first_name_last_name_index')) {
            Schema::table('student_records', function (Blueprint $table) {
                $table->dropIndex(['first_name', 'last_name']);
            });
        }

        // Remove indexes from staff_records table if they exist
        if ($indexExists('staff_records', 'staff_records_staff_id_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->dropIndex(['staff_id']);
            });
        }

        if ($indexExists('staff_records', 'staff_records_first_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->dropIndex(['first_name']);
            });
        }

        if ($indexExists('staff_records', 'staff_records_last_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->dropIndex(['last_name']);
            });
        }

        if ($indexExists('staff_records', 'staff_records_first_name_last_name_index')) {
            Schema::table('staff_records', function (Blueprint $table) {
                $table->dropIndex(['first_name', 'last_name']);
            });
        }

        // Remove indexes from payments table if they exist
        if ($indexExists('payments', 'payments_payment_date_index')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropIndex(['payment_date']);
            });
        }

        if ($indexExists('payments', 'payments_payment_status_index')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropIndex(['payment_status']);
            });
        }

        // Remove indexes from attendances table if they exist
        if ($indexExists('attendances', 'attendances_date_index')) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->dropIndex(['date']);
            });
        }

        if ($indexExists('attendances', 'attendances_status_index')) {
            Schema::table('attendances', function (Blueprint $table) {
                $table->dropIndex(['status']);
            });
        }
    }
} 