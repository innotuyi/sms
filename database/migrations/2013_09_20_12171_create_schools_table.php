<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_code')->default('SCH01');
            $table->string('school_name')->nullable();
            $table->string('school_status')->nullable();
            $table->string('school_level')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('sector')->nullable();
            $table->string('grade')->nullable();
            $table->string('level')->nullable();
            $table->string('trade')->nullable();
            $table->string('combination')->nullable();
            $table->string('area')->nullable();
            $table->string('level_status')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('principal_name')->nullable();          
            $table->integer('established_year')->nullable();
            $table->string('school_type')->nullable(); // e.g., Public, Private
            $table->string('registration_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
