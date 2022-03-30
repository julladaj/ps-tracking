<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterExtraKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_extra_keys', function (Blueprint $table) {
            $table->foreignId('meter_id')->constrained('meters');
            $table->string('key_name');
            $table->string('key_value');
            $table->primary(['meter_id', 'key_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_extra_keys');
    }
}
