<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->decimal('basic_salary', 15, 2);
            $table->decimal('allowances', 15, 2)->default(0.00);
            $table->decimal('deductions', 15, 2)->default(0.00);
            $table->decimal('net_salary', 15, 2)->default(0.00);
            $table->date('payment_date');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('payrolls');
    }
}
