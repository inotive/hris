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
        Schema::create('approvers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->after('id');

            $table->string('request_type');

            
            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->integer('approver_level');

            $table->string('approver_employee_id')->nullable();
            $table->foreign('approver_employee_id')->references('id')->on('employees');


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
        Schema::dropIfExists('approvers');
    }
};
