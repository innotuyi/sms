<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedingTimetablesTable extends Migration
{
    public function up()
    {
        Schema::create('feeding_timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('day_of_week');
            $table->string('morning_meal');
            $table->string('lunch_meal');
            $table->string('dinner_meal');
            $table->text('special_notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feeding_timetables');
    }
} 