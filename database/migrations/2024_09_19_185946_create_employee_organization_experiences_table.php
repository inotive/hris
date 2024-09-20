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
        Schema::create('employee_organization_experiences', function (Blueprint $table) {
            $table->uuid('id')->primary();


            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');


            $table->string('company_name')->nullable();
            $table->string('company_location')->nullable();
            $table->string('line_of_business')->nullable();
            $table->string('position_held')->nullable();
            $table->text('job_description')->nullable();
            $table->text('achievement')->nullable();
            $table->date('start_period')->nullable();
            $table->date('end_period')->nullable();
            $table->string('initial_currency')->nullable();
            $table->double('initial_sallary')->nullable();
            $table->string('initial_period')->nullable();
            $table->string('last_currency')->nullable();
            $table->integer('last_sallary')->nullable();
            $table->string('last_period')->nullable();
            $table->string('reason_leaving')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('reference_phone')->nullable();
            $table->string('reference_position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_organization_experiences');
    }
};
