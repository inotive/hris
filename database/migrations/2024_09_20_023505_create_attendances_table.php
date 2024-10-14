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
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->foreignUuid('employee_shift_id')->nullable();
            $table->foreign('employee_shift_id')->references('id')->on('employee_shifts');

            $table->date('date');
            $table->timestamp('checkin_time');
            $table->text('checkin_image');
            $table->string('checkin_lat');
            $table->string('checkin_long');
            $table->timestamp('checkout_time')->nullable();
            $table->text('checkout_image');
            $table->string('checkout_lat');
            $table->string('checkout_long');

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
        Schema::dropIfExists('attendances');
    }
};
