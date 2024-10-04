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
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->integer('nik')->nullable()->after('email');
            $table->boolean('document_is_unlimited')->nullable()->after('document_id');
            $table->string('document_file')->nullable()->after('document_is_unlimited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
            $table->dropColumn('nik');
            $table->dropColumn('document_is_unlimited');
            $table->dropColumn('document_file');
        });
    }
};
