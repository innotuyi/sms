<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('university_code')->unique();
            $table->string('name');
            $table->string('type')->comment('public/private');
            $table->string('province')->nullable();
            $table->string('district');
            $table->string('sector')->nullable();
            $table->string('address');
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('rector_name')->nullable();
            $table->integer('established_year')->nullable();
            $table->text('description')->nullable();
            $table->string('accreditation_status')->nullable();
            $table->json('faculties')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('universities');
    }
} 