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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id')->nullable();
            $table->uuid('manager_id')->nullable();
            $table->uuid('employee_id')->nullable();
            $table->uuid('employee_shift_id')->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('password', 250)->nullable();
            $table->string('phone', 15)->nullable();
            $table->uuid('department_id')->nullable();
            $table->uuid('employee_position_id')->nullable();
            $table->uuid('employee_level_id')->nullable();
            $table->date('hire_date')->nullable();
            $table->integer('sallary')->nullable();
            $table->string('image', 250)->nullable();
            $table->integer('reimbursement_limit')->nullable();
            $table->uuid('created_by_user_id')->nullable();
            $table->timestamps();

            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
