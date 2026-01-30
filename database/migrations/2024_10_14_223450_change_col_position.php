<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        //
        $databaseName = DB::connection()->getDatabaseName();

        $tables = DB::select("SELECT TABLE_NAME as tbl 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = '$databaseName'
        
        AND TABLE_NAME NOT IN ('jobs','failed_jobs')
        ");

     
        foreach($tables as $key => $value) {
            $table = $value->tbl;

            if (Schema::hasColumn($table, 'created_at')) {
             

                $fields = DB::select("SELECT COLUMN_NAME as col 
                    FROM INFORMATION_SCHEMA.COLUMNS 

                        WHERE TABLE_SCHEMA = '".$databaseName."' AND
                        TABLE_NAME = '$table' 

                AND COLUMN_NAME NOT IN ('created_at','updated_at','created_by_user_id')
                    ORDER BY ORDINAL_POSITION DESC LIMIT 1");
                
                $field = null;
                foreach($fields as $k2 => $val2) {
                    $field = $val2->col;
                }
                
                DB::statement("ALTER TABLE $table MODIFY created_at TIMESTAMP NULL AFTER `$field`");
        
                if (Schema::hasColumn($table, 'updated_at')) {
                DB::statement("ALTER TABLE $table MODIFY updated_at TIMESTAMP NULL AFTER created_at");
                }

                if (Schema::hasColumn($table, 'created_by_id')) {
                    DB::statement("ALTER TABLE $table MODIFY created_by_id VARCHAR NULL AFTER created_at");
                }
            }
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
