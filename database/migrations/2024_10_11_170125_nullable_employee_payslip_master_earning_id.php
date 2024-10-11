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
        Schema::table('employee_payslip_details', function (Blueprint $table) {
            //
            $table->foreignUuid('employee_payslip_master_earning_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_payslip_details', function (Blueprint $table) {
            //
            $table->foreignUuid('employee_payslip_master_earning_id')->nullable()->change();
        });
    }
};
