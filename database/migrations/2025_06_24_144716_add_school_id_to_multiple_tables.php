<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolIdToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add school_id to attendances table
        Schema::table('attendances', function (Blueprint $table) {
            if (!Schema::hasColumn('attendances', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to books table
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to past_papers table
        Schema::table('past_papers', function (Blueprint $table) {
            if (!Schema::hasColumn('past_papers', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to expenses table
        Schema::table('expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to leaves table
        Schema::table('leaves', function (Blueprint $table) {
            if (!Schema::hasColumn('leaves', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to payrolls table
        Schema::table('payrolls', function (Blueprint $table) {
            if (!Schema::hasColumn('payrolls', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });

        // Add school_id to vehicles table
        Schema::table('vehicles', function (Blueprint $table) {
            if (!Schema::hasColumn('vehicles', 'school_id')) {
                $table->unsignedBigInteger('school_id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove school_id from attendances table
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from books table
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from past_papers table
        Schema::table('past_papers', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from expenses table
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from leaves table
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from payrolls table
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        // Remove school_id from vehicles table
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
    }
}
