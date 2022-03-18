<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReplaceKvaToTransformersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transformers', function (Blueprint $table) {
            $sql_command = "
UPDATE `transformers` 
SET `description` = replace(`description`, ' kVA', '');
            ";
            DB::unprepared($sql_command);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transformers', function (Blueprint $table) {
            // nothing
        });
    }
}
