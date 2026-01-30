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
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('clockin_time');
            $table->dropColumn('clockout_time');
        });
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('clockin_time')->nullable();
            $table->string('clockout_time')->nullable();
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
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('clockin_time');
            $table->dropColumn('clockout_time');
        });
        Schema::table('attendances', function (Blueprint $table) {
            //
            $table->timestampTz('created_at')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->timestampTz('clockin_time')->nullable();
            $table->timestampTz('clockout_time')->nullable();
        });
    }
};
