<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdColumnToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables=DB::select('SHOW TABLES');
        $database_tables=[];
        foreach ($tables as $key => $table_name) {
            $table_name=json_encode(array_values(get_object_vars($table_name)));
            $table_name =str_replace(['["','"]'],'',$table_name);
            Schema::table($table_name, function (Blueprint $table) use($table_name) {
                if (!Schema::hasColumn($table_name, 'branch_id')) {
                    $table->tinyInteger('branch_id')->default(1);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all', function (Blueprint $table) {
            //
        });
    }
}
