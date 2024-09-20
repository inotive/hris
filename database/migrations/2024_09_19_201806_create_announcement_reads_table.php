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
        Schema::create('announcement_reads', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->foreignUuid('announcement_id')->nullable();
            $table->foreign('announcement_id')->references('id')->on('announcements');

            $table->timestamp('read_at');

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
        Schema::dropIfExists('announcement_reads');
    }
};
