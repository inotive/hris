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
        Schema::table('attendances', function (Blueprint $table) {
            //
           // Add new columns with the desired names and types
           $table->timestamp('clockin_time', 6)->nullable()->change();  // Adjust nullable as needed
           $table->string('clockin_image')->nullable()->change();        // Adjust type as needed
           $table->decimal('clockin_lat', 10, 6)->nullable()->change(); // Adjust type as needed
           $table->decimal('clockin_long', 10, 6)->nullable()->change(); // Adjust type as needed
           $table->timestamp('clockout_time', 6)->nullable()->change(); // Adjust nullable as needed
           $table->string('clockout_image')->nullable()->change();       // Adjust type as needed
           $table->decimal('clockout_lat', 10, 6)->nullable()->change(); // Adjust type as needed
           $table->decimal('clockout_long', 10, 6)->nullable()->change(); // Adjust type as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->timestamp('clockin_time', 6)->nullable()->change();  // Adjust nullable as needed
            $table->string('clockin_image')->nullable()->change();        // Adjust type as needed
            $table->decimal('clockin_lat', 10, 6)->nullable()->change(); // Adjust type as needed
            $table->decimal('clockin_long', 10, 6)->nullable()->change(); // Adjust type as needed
            $table->timestamp('clockout_time', 6)->nullable()->change(); // Adjust nullable as needed
            $table->string('clockout_image')->nullable()->change();       // Adjust type as needed
            $table->decimal('clockout_lat', 10, 6)->nullable()->change(); // Adjust type as needed
            $table->decimal('clockout_long', 10, 6)->nullable()->change(); // Adjust type as needed
        });
    }
};
