<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            
            // Academic Settings
            $table->string('academic_year')->nullable();
            $table->string('term')->nullable();
            $table->date('term_start_date')->nullable();
            $table->date('term_end_date')->nullable();
            $table->time('school_start_time')->nullable();
            $table->time('school_end_time')->nullable();
            
            // Grading System
            $table->json('grading_system')->nullable(); // Store grading scale as JSON
            $table->decimal('passing_grade', 5, 2)->nullable();
            
            // Attendance Settings
            $table->integer('max_absent_days')->nullable();
            $table->integer('max_late_days')->nullable();
            
            // Fee Settings
            $table->decimal('tuition_fee', 10, 2)->nullable();
            $table->decimal('transportation_fee', 10, 2)->nullable();
            $table->decimal('boarding_fee', 10, 2)->nullable();
            $table->string('payment_currency')->default('RWF');
            
            // Communication Settings
            $table->string('sms_gateway')->nullable();
            $table->string('email_gateway')->nullable();
            $table->boolean('enable_sms_notifications')->default(false);
            $table->boolean('enable_email_notifications')->default(false);
            
            // System Settings
            $table->string('timezone')->default('Africa/Kigali');
            $table->string('date_format')->default('Y-m-d');
            $table->string('language')->default('en');
            $table->json('custom_fields')->nullable(); // For school-specific custom fields
            
            // Theme Settings
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('banner_path')->nullable();
            
            $table->timestamps();
            
            // Add indexes for frequently queried fields
            $table->index(['school_id', 'academic_year']);
            $table->index('term');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_settings');
    }
} 