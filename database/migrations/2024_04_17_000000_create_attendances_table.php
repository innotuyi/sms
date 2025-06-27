<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id'); // References student_records.id
            $table->unsignedInteger('teacher_id'); // References users.id (assuming teachers are in the users table)
            $table->unsignedInteger('section_id'); // References sections.id
            $table->date('attendance_date');
            $table->enum('status', ['present', 'absent', 'late']); // Status of attendance
            $table->text('remarks')->nullable(); // Remarks for the attendance
            $table->foreign('student_id')->references('id')->on('student_records')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('attendances');
    }
}
