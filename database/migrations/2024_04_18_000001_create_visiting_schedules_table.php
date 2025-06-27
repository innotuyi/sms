<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitingSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('visiting_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('month');
            $table->date('visiting_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('special_instructions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visiting_schedules');
    }
} 