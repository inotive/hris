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
            $table->dropColumn('manager_id');
            $table->string('username')->unique()->nullable();
            $table->string('birth_place')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('zip_code')->nullable();
            $table->date('join_date')->nullable();
            $table->string('document_id')->nullable();
            $table->date('document_expiry')->nullable();
            $table->string('tax_registered_name')->nullable();
            $table->string('tax_number')->nullable();

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


            $table->uuid('manager_id')->nullable();
            $table->dropColumn('username');
            $table->dropColumn('birth_place');
            $table->dropColumn('religion');
            $table->dropColumn('marital_status');
            $table->dropColumn('gender');
            $table->dropColumn('nationality');
            $table->dropColumn('country');
            $table->dropColumn('address');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('district');
            $table->dropColumn('sub_district');
            $table->dropColumn('zip_code');
            $table->dropColumn('join_date');
            $table->dropColumn('document_id');
            $table->dropColumn('document_expiry');
            $table->dropColumn('tax_registered_name');
            $table->dropColumn('tax_number');
        });
    }
};
