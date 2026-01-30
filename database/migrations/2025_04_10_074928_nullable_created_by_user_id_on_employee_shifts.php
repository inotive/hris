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
        Schema::table('employee_shifts', function (Blueprint $table) {
            //
            $table->uuid('created_by_user_id')->nullable()->change();
        });

        Schema::table('employee_positions', function (Blueprint $table) {
            //
            $table->uuid('created_by_user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_shifts', function (Blueprint $table) {
            //
            $table->uuid('created_by_user_id')->nullable(false)->change();
        });


        Schema::table('employee_positions', function (Blueprint $table) {
            //
            $table->uuid('created_by_user_id')->nullable(false)->change();
        });
    }
};
