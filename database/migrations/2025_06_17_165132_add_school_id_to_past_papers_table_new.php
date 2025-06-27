<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('past_papers', function (Blueprint $table) {
            if (!Schema::hasColumn('past_papers', 'school_id')) {
                $table->unsignedBigInteger('school_id')->after('id')->nullable();
                $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('past_papers', function (Blueprint $table) {
            if (Schema::hasColumn('past_papers', 'school_id')) {
                $table->dropForeign(['school_id']);
                $table->dropColumn('school_id');
            }
        });
    }
};
