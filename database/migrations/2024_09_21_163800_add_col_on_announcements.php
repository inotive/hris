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
        Schema::dropIfExists('announcement_reads');
        Schema::dropIfExists('announcements');
        Schema::create('announcements', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');


            $table->foreignUuid('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('employees');


            $table->foreignUuid('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');


            $table->string('title');
            $table->longText('content');
            $table->string('reference');

            $table->string('type')->default('announcement');

            $table->string('module')->nullable();
            $table->foreignUuid('module_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('read_at')->nullable();


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
        Schema::table('announcements', function (Blueprint $table) {
       
        });
    }
};
