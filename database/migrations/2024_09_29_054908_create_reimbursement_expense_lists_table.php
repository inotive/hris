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
        Schema::create('reimbursement_expense_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
           

            $table->foreignUuid('reimbursement_request_id');
            $table->foreign('reimbursement_request_id')->references('id')->on('reimbursement_requests');


            $table->foreignUuid('reimbursement_expense_id');
            $table->foreign('reimbursement_expense_id')->references('id')->on('reimbursement_expenses');

            $table->string('name');
            $table->bigInteger('value');

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
        Schema::dropIfExists('reimbursement_expense_lists');
    }
};
