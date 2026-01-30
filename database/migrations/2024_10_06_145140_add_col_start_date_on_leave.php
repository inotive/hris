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
            $table->renameColumn('date', 'start_date')->change();
            $table->integer('total_days')->after('date');
            $table->date('end_date')->after('date');
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
            $table->renameColumn('start_date','date')->change();
            $table->dropColumn('end_date');
            $table->dropColumn('total_days');
        });
    }
};
