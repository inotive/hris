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
        Schema::create('ptkps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type_ter');
            $table->bigInteger('value_start');
            $table->bigInteger('value_end');
            $table->bigInteger('value');
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
        Schema::dropIfExists('ptkps');
    }
};
