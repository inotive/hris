<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payslips', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
           
            $table->bigInteger('total_payslip_earning')->default(0);
            $table->bigInteger('total_payslip_deduction')->default(0);
            $table->bigInteger('sub_total_payslip')->default(0);
            $table->bigInteger('tax')->default(0);
            $table->bigInteger('take_home_pay')->default(0);
            $table->date('pay_date')->nullable();
            $table->string('metode')->nullable();
            $table->integer('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('file')->nullable();

            $table->foreignUuid('created_by_user_id')->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users');
            

            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_payslips');
    }
};
