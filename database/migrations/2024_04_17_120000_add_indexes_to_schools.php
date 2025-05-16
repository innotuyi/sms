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
            $table->dropIndex(['school_code']);
            $table->dropIndex(['district']);
            $table->dropIndex(['school_status']);
            $table->dropIndex(['school_type']);
            $table->dropIndex(['school_level']);
            $table->dropIndex(['province', 'district', 'sector']);
        });
    }
} 