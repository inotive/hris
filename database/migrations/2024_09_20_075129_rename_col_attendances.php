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
            $table->renameColumn('checkin_time', 'clockin_time');
            $table->renameColumn('checkin_image','clockin_image');
            $table->renameColumn('checkin_lat','clockin_lat');
            $table->renameColumn('checkin_long','clockin_long');
            $table->renameColumn('checkout_time','clockout_time');
            $table->renameColumn('checkout_image','clockout_image');
            $table->renameColumn('checkout_lat','clockout_lat');
            $table->renameColumn('checkout_long','clockout_long');
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
            $table->renameColumn('clockin_time', 'checkin_time');
            $table->renameColumn('clockin_image', 'checkin_image');
            $table->renameColumn('clockin_lat', 'checkin_lat');
            $table->renameColumn('clockin_long', 'checkin_long');
            $table->renameColumn('clockout_time', 'checkout_time');
            $table->renameColumn('clockout_image', 'checkout_image');
            $table->renameColumn('clockout_lat', 'checkout_lat');
            $table->renameColumn('clockout_long', 'checkout_long');
        });
    }
};
