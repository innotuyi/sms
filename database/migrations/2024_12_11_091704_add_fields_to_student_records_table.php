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
            // Only add school_id if it doesn't exist
            if (!Schema::hasColumn('student_records', 'school_id')) {
                $table->unsignedBigInteger('school_id');
                $table->foreign('school_id')
                    ->references('id')
                    ->on('schools')
                    ->onDelete('cascade');
            }

            // Add other columns only if they don't exist
            if (!Schema::hasColumn('student_records', 'arrival_time')) {
                $table->dateTime('arrival_time')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'departure_time')) {
                $table->dateTime('departure_time')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'brought_by')) {
                $table->dateTime('brought_by')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'sickness')) {
                $table->string('sickness')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'insurance')) {
                $table->string('insurance')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'special_insurance')) {
                $table->string('special_insurance')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'fees_status')) {
                $table->string('fees_status')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'fees_paid')) {
                $table->integer('fees_paid')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'remaining_fees')) {
                $table->integer('remaining_fees')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'balance_date')) {
                $table->date('balance_date')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'other_organization')) {
                $table->string('other_organization')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'pocket_money')) {
                $table->integer('pocket_money')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'pocket_money_to_go_home')) {
                $table->string('pocket_money_to_go_home')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'pocket_money_amount')) {
                $table->integer('pocket_money_amount')->nullable();
            }
            if (!Schema::hasColumn('student_records', 'hygiene_materials_complete')) {
                $table->string('hygiene_materials_complete')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('student_records', function (Blueprint $table) {
            // Drop columns only if they exist
            $columnsToDrop = [
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
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('student_records', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
    
}
