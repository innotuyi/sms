<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaysWithParentToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persmissions', function (Blueprint $table) {
            $table->integer('days_with_parent')->nullable()->after('status'); // Add the column here
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persmissions', function (Blueprint $table) {
            $table->dropColumn('days_with_parent'); // Drop the column on rollback
        });
    }
}
