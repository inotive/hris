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
            $table->boolean('wd_monday')->default(false);
            $table->boolean('wd_tuesday')->default(false);
            $table->boolean('wd_wednesday')->default(false);
            $table->boolean('wd_thursday')->default(false);
            $table->boolean('wd_friday')->default(false);
            $table->boolean('wd_saturday')->default(false);
            $table->boolean('wd_sunday')->default(false);

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
            $table->dropColumn('wd_monday');
            $table->dropColumn('wd_tuesday');
            $table->dropColumn('wd_wednesday');
            $table->dropColumn('wd_thursday');
            $table->dropColumn('wd_friday');
            $table->dropColumn('wd_saturday');
            $table->dropColumn('wd_sunday');
            
        });
    }
};
