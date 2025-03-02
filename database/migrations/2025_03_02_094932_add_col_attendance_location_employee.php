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
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->boolean('is_attendance_location')->default(false);
            $table->boolean('is_overtime_request')->default(false);
            $table->boolean('is_reimbursement_request')->default(false);
            $table->boolean('is_attendance')->default(false);
            $table->boolean('is_payslip')->default(false);
            $table->boolean('is_ewa')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->dropColumn('is_attendance_location');
            $table->dropColumn('is_overtime_request');
            $table->dropColumn('is_reimbursement_request');
            $table->dropColumn('is_attendance');
            $table->dropColumn('is_payslip');
            $table->dropColumn('is_ewa');
            

        });
    }
};
