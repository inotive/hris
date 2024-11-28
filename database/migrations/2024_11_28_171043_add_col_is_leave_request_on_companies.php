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
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->boolean('is_leave_request')->default(false);
            $table->boolean('is_reimbursement_request')->default(false);
            $table->boolean('is_attendance')->default(false);
            $table->boolean('is_ewa')->default(false);
            $table->boolean('is_payslip')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->dropColumn('is_leave_request');
            $table->dropColumn('is_reimbursement_request');
            $table->dropColumn('is_attendance');
            $table->dropColumn('is_ewa');
            $table->dropColumn('is_payslip');
        });
    }
};
