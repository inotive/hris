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
        Schema::create('employee_education', function (Blueprint $table) {
            $table->uuid('id')->primary();


            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->string('institution')->nullable();
            $table->string('education_level')->nullable();
            $table->string('faculty')->nullable();
            $table->string('major')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->double('gpa')->nullable();
            $table->double('gpa_scale')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->boolean('default')->nullable();
            $table->string('certificate_no')->nullable();
            $table->date('certificate_date')->nullable();
            $table->string('certificate_file')->nullable();
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
        Schema::dropIfExists('employee_education');
    }
};
