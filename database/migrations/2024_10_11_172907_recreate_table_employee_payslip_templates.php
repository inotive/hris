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
        Schema::dropIfExists('employee_payslip_templates');
        Schema::create('employee_payslip_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();
    
            $table->string('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->string('employee_payslip_master_id')->nullable();
            $table->foreign('employee_payslip_master_id')->references('id')->on('employee_payslip_masters');

            $table->string('payslip_type');
            $table->string('type');
            $table->integer('value')->nullable();

            $table->string('created_by_user_id')->nullable();
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
        Schema::dropIfExists('employee_payslip_templates');
    }
};
