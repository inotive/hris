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
            // Drop old columns
            $table->dropColumn(['checkin_time', 'checkin_image', 'checkin_lat', 'checkin_long']);
            $table->dropColumn(['checkout_time', 'checkout_image', 'checkout_lat', 'checkout_long']);

            // Add new columns with the desired names and types
            $table->timestamp('clockin_time', 6)->nullable();  // Adjust nullable as needed
            $table->string('clockin_image')->nullable();        // Adjust type as needed
            $table->decimal('clockin_lat', 10, 6)->nullable(); // Adjust type as needed
            $table->decimal('clockin_long', 10, 6)->nullable(); // Adjust type as needed
            $table->timestamp('clockout_time', 6)->nullable(); // Adjust nullable as needed
            $table->string('clockout_image')->nullable();       // Adjust type as needed
            $table->decimal('clockout_lat', 10, 6)->nullable(); // Adjust type as needed
            $table->decimal('clockout_long', 10, 6)->nullable(); // Adjust type as needed
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
            // Drop new columns
            $table->dropColumn(['clockin_time', 'clockin_image', 'clockin_lat', 'clockin_long']);
            $table->dropColumn(['clockout_time', 'clockout_image', 'clockout_lat', 'clockout_long']);

            // Add back the old columns with their original names and types
            $table->timestamp('checkin_time', 6)->nullable();  // Adjust type as necessary
            $table->string('checkin_image')->nullable();        // Adjust type as necessary
            $table->decimal('checkin_lat', 10, 6)->nullable(); // Adjust type as necessary
            $table->decimal('checkin_long', 10, 6)->nullable(); // Adjust type as necessary
            $table->timestamp('checkout_time', 6)->nullable(); // Adjust type as necessary
            $table->string('checkout_image')->nullable();       // Adjust type as necessary
            $table->decimal('checkout_lat', 10, 6)->nullable(); // Adjust type as necessary
            $table->decimal('checkout_long', 10, 6)->nullable(); // Adjust type as necessary
        });
    }
};
