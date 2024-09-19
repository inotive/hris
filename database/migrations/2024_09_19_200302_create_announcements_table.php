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
        Schema::create('announcements', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');



            $table->foreignUuid('for_employee_id')->nullable();
            $table->foreign('for_employee_id')->references('id')->on('employees');


            $table->foreignUuid('created_by_employee_id')->nullable();
            $table->foreign('created_by_employee_id')->references('id')->on('employees');
           
           
            $table->foreignUuid('created_by_user_id')->nullable();
            $table->foreign('created_by_user_id')->references('id')->on('users');


            $table->string('title');
            $table->longText('content');
            $table->string('reference');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
