<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixSubjectsSchoolIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('subjects')) {
            // First, let's see what school_ids we have in subjects
            $invalidSchoolIds = DB::select("
                SELECT DISTINCT school_id 
                FROM subjects 
                WHERE school_id IS NOT NULL 
                AND school_id NOT IN (SELECT id FROM schools)
            ");

            // If we found any invalid school_ids, update them to the default school
            if (!empty($invalidSchoolIds)) {
                DB::statement("
                    UPDATE subjects 
                    SET school_id = 3496 
                    WHERE school_id IS NOT NULL 
                    AND school_id NOT IN (SELECT id FROM schools)
                ");
            }

            // Also ensure no NULL values exist
            DB::table('subjects')
                ->whereNull('school_id')
                ->update(['school_id' => 3496]);
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