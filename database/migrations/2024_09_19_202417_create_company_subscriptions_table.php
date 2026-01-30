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
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();



            $table->foreignUuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->date('start_date_at');
            $table->date('end_date_at');
            $table->string('subscription_type')->nullable();
            $table->text('subscription_description');
            $table->integer('price');
            $table->string('payment_bank_account_no');
            $table->string('payment_bank_account_name');
            $table->string('payment_bank_account_logo');
            $table->timestamp('payment_at');
            $table->boolean('payment_status');
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
        Schema::dropIfExists('company_subscriptions');
    }
};
