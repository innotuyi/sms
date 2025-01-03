<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('past_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['Ibizamini by’abalimu', 'Ibizamini bya Leta']);
            $table->string('file_path'); // Path to the PDF or file
            $table->string('academic_year'); // Example: '2023-2024'
            $table->string('subject'); // Example: 'Mathematics', 'English'
            $table->enum('level', ['Primary', "O\\'level", "A\\'level"]); // Escape single quotes in enum values
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
        Schema::dropIfExists('past_papers');
    }
}
