<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->index('school_code');
            $table->index('district');
            $table->index('school_status');
            $table->index('school_type');
            $table->index('school_level');
            $table->index(['province', 'district', 'sector']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            // $table->dropIndex(['school_code']); // Commented out to avoid error
            // $table->dropIndex(['district']); // Commented out to avoid error
            // $table->dropIndex(['school_status']); // Commented out to avoid error
            // $table->dropIndex(['school_type']); // Commented out to avoid error
            // $table->dropIndex(['school_level']); // Commented out to avoid error
            // $table->dropIndex(['province', 'district', 'sector']); // Commented out to avoid error
        });
    }
} 