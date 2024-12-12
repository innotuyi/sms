<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStudentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id'); // Define the column
            $table->dateTime('arrival_time')->nullable();
            $table->dateTime('departure_time')->nullable();
            $table->dateTime('brought_by')->nullable();
            $table->string('sickness')->nullable();
            $table->string('insurance')->nullable();
            $table->string('special_insurance')->nullable();
            $table->string('fees_status')->nullable();
            $table->integer('fees_paid')->nullable();
            $table->integer('remaining_fees')->nullable();
            $table->date('balance_date')->nullable();
            $table->string('other_organization')->nullable();
            $table->integer('pocket_money')->nullable();
            $table->string('pocket_money_to_go_home')->nullable();
            $table->integer('pocket_money_amount')->nullable();
            $table->string('hygiene_materials_complete')->nullable();

            $table->foreign('school_id') // Add the foreign key constraint
            ->references('id') // Reference the primary key of the related table
            ->on('schools') // Specify the table being referenced
            ->onDelete('cascade'); // Define what happens on deletion (optional, e.g., cascade delete)

        });
    }
    
    public function down()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->dropForeign(['school_id']); // Drop the foreign key
            $table->dropColumn('school_id'); // Drop the column
    
            $table->dropColumn([
                'arrival_time',
                'departure_time',
                'brought_by',
                'sickness',
                'insurance',
                'special_insurance',
                'fees_status',
                'fees_paid',
                'remaining_fees',
                'balance_date',
                'other_organization',
                'pocket_money',
                'pocket_money_to_go_home',
                'pocket_money_amount',
                'hygiene_materials_complete'
            ]);
        });
    }
    
}
