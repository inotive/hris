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
        Schema::create('reimbursement_types', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->foreignUuid('created_by_user_id')->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users');
            


    
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reimbursement_types');
    }
};
