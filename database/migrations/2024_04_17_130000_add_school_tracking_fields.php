<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolTrackingFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('registration_number');
            $table->timestamp('last_sync')->nullable()->after('is_active');
            $table->integer('total_students')->default(0)->after('last_sync');
            $table->integer('total_teachers')->default(0)->after('total_students');
            $table->json('facilities')->nullable()->after('total_teachers');
            $table->json('performance_metrics')->nullable()->after('facilities');
            $table->string('last_inspection_date')->nullable()->after('performance_metrics');
            $table->string('inspection_status')->nullable()->after('last_inspection_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn([
                'is_active',
                'last_sync',
                'total_students',
                'total_teachers',
                'facilities',
                'performance_metrics',
                'last_inspection_date',
                'inspection_status'
            ]);
        });
    }
} 