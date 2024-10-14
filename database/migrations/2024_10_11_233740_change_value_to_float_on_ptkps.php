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
        Schema::table('ptkps', function (Blueprint $table) {
            //
            $table->float('value', 100,2)->nullable()->change();

            $table->string('created_by_user_id')->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users')->after('note');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ptkps', function (Blueprint $table) {
            //
            $table->float('value', 100,2)->nullable()->change();
            $table->dropForeign('ptkps_created_by_user_id_foreign');
            $table->dropColumn('created_by_user_id');
        });
    }
};
