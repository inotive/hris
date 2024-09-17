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
        Schema::create('employee_payslip_details', function (Blueprint $table) {
            $table->uuid('id')->primary();     
            $table->foreignUuid('company_id');
            $table->foreignUuid('created_by_user_id');
            $table->foreignUuid('employee_payslip_master_earning_id');
            $table->string('payslip_type')->default('earning');
            $table->integer('value')->default(0);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('employee_payslip_master_earning_id', 'fk_earning_id') // shortened foreign key name
                ->references('id')
                ->on('employee_payslip_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_payslip_details');
    }
};
