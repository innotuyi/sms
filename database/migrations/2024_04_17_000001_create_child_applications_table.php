<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_applications', function (Blueprint $table) {
            $table->id();
            $table->string('child_full_name');
            $table->string('category');
            $table->string('option')->nullable();
            $table->decimal('marks_percentage', 5, 2);
            $table->string('marks_attachment');
            $table->string('parent_full_name');
            $table->string('parent_email');
            $table->string('parent_phone');
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
        Schema::dropIfExists('child_applications');
    }
}
