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
            $table->string('document_bpjstk_file')->nullable()->after('document_expiry');
            $table->string('document_bpjstk_name')->nullable()->after('document_expiry');
            $table->string('document_bpjstk_no')->nullable()->after('document_expiry');
            $table->string('document_bpjs_file')->nullable()->after('document_expiry');
            $table->string('document_bpjs_name')->nullable()->after('document_expiry');
            $table->string('document_bpjs_no')->nullable()->after('document_expiry');
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
            $table->dropColumn([
                'document_bpjstk_file',
                'document_bpjstk_name',
                'document_bpjstk_no',
                'document_bpjs_file',
                'document_bpjs_name',
                'document_bpjs_no',
            ]);
        });
    }
};
