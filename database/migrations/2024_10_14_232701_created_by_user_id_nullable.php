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
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            //
            $table->foreignUuid('created_by_user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reimbursement_requests', function (Blueprint $table) {
            //
            $table->foreignUuid('created_by_user_id')->nullable()->change();
        });
    }
};
