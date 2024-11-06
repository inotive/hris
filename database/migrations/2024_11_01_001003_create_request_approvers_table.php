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
        Schema::create('request_approvers', function (Blueprint $table) {
            $table->uuid('id')->primary();
                   
            $table->string('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('requests')->after('id');

            $table->string('approver_employee_id')->nullable();
            $table->foreign('approver_employee_id')->references('id')->on('employees');

            $table->integer('approver_level');
            $table->string('approver_status')->default('pending');
            $table->timestampTz('approved_at')->nullable();

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
        Schema::dropIfExists('request_approvers');
    }
};
