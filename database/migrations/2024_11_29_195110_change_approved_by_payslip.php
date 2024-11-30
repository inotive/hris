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
        Schema::table('employee_payslips', function (Blueprint $table) {
            $table->dropForeign('employee_payslips_approved_by_user_id_foreign');
            $table->dropColumn('approved_by_user_id');
        });
        Schema::table('employee_payslips', function (Blueprint $table) {

            $table->uuid('approved_by_user_id')->nullable();
            $table->foreign('approved_by_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_payslips', function (Blueprint $table) {
            $table->dropForeign('employee_payslips_approved_by_user_id_foreign');
            $table->dropColumn('approved_by_user_id');
        });
        Schema::table('employee_payslips', function (Blueprint $table) {

            $table->uuid('approved_by_user_id')->nullable();
            $table->foreign('approved_by_user_id')->references('id')->on('users');
        });
    }
};
