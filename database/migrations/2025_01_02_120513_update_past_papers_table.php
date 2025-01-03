<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePastPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('past_papers', function (Blueprint $table) {
            // Remove the 'file_path' column
            $table->dropColumn('file_path');
            
            // Add a new column for the file name
            $table->string('file_name')->after('type'); // Holds the name of the uploaded file
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('past_papers', function (Blueprint $table) {
            // Add the 'file_path' column back
            $table->string('file_path')->after('type');
            
            // Remove the 'file_name' column
            $table->dropColumn('file_name');
        });
    }
}
