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
            $table->foreignUuid('employee_payslip_id');


            $table->foreign('employee_payslip_id')->references('id')->on('employee_payslips');
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

            $table->dropForeign('employee_payslip_details_employee_payslip_id_foreign');
            $table->dropColumn('employee_payslip_id');
        });
    }
};
