<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserIdToUuid extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the current integer primary key
            $table->dropPrimary('id');
            
            // Change the id column to UUID
            $table->uuid('id')->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert back to integer ID if needed
            $table->dropPrimary('id');
            $table->bigIncrements('id')->primary()->change();
        });
    }
}
