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
        Schema::table('leave_requests', function (Blueprint $table) {
            //
            $table->string('request_no')->nullable();
        });
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            //
            $table->string('request_no')->nullable();
        });
        Schema::table('overtime_requests', function (Blueprint $table) {
            //
            $table->string('request_no')->nullable();
        });
        Schema::table('requests', function (Blueprint $table) {
            //
            $table->string('request_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            //
            $table->dropColumn('request_no');
        });
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            //
            $table->dropColumn('request_no');
        });
        Schema::table('overtime_requests', function (Blueprint $table) {
            //
            $table->dropColumn('request_no');
        });
        Schema::table('requests', function (Blueprint $table) {
            //
            $table->dropColumn('request_no');
        });
    }
};
