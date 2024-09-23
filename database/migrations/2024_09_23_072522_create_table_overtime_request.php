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
        Schema::create('overtime_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');


            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
           
            $table->foreignUuid('overtime_shift_request_id')->nullable();
            $table->foreign('overtime_shift_request_id')->references('id')->on('overtime_shift_requests');


            $table->timestampTz('start_shift_date_time')->nullable();
            $table->timestampTz('end_shift_date_time')->nullable();
           
            $table->text('compensation')->nullable();
            $table->text('work_note')->nullable();
           
            $table->foreignUuid('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('employees');

            $table->string('status')->default('pending');
           
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
        Schema::dropIfExists('overtime_requests');
    }
};
