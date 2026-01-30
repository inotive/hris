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
        Schema::create('employee_payslip_generates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->after('id');

            $table->integer('month');
            $table->integer('yeaer');
            $table->string('data_generate_total');
            $table->string('data_generate_status');
            $table->timestampTz('approved_at')->nullable();
            $table->timestampTz('generated_at')->nullable();

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
        Schema::dropIfExists('employee_payslip_generates');
    }
};
