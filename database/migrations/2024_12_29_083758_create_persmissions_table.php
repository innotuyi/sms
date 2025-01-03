<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persmissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id'); // foreign key to the student
            $table->unsignedInteger('parent_id'); // foreign key to the parent (assuming the parent is a user in the system)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // status of the request
            $table->text('reason')->nullable(); // reason for the permission request    
            // Foreign keys
            $table->foreign('student_id')->references('id')->on('student_records')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade'); // assuming parent is a user in the system
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
        Schema::dropIfExists('persmissions');
    }
}
