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
            //
            $table->timestampTz('generated_at')->nullable();
            $table->timestampTz('approved_at')->nullable();

            
            $table->string('approved_by_user_id')->nullable();
            $table->foreign('approved_by_user_id')->references('id')->on('employees');


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
            //
            $table->dropColumn('generated_at');
            $table->dropColumn('approved_at');
            $table->dropColumn('approved_by_user_id');
        });
    }
};
