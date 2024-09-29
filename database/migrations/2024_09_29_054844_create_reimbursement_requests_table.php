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
        Schema::create('reimbursement_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
           
            $table->date('date');

            $table->foreignUuid('reimbursement_type_id');
            $table->foreign('reimbursement_type_id')->references('id')->on('reimbursement_types');


            $table->bigInteger('total');

            $table->foreignUuid('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('employees');
           
            $table->string('status')->default('pending');

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
        Schema::dropIfExists('reimbursement_requests');
    }
};
