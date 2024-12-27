<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBroughtByToStringInStudentRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->string('brought_by')->nullable()->change(); // Change to string and make nullable
        });
    }

    public function down()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->dateTime('brought_by')->nullable()->change(); // Revert to original data type
        });
    }
}
