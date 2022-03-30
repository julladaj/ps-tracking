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
            $table->id();
            $table->foreignId('meter_id')->constrained('meters');
            $table->string('type_name');
            $table->integer('type_id');
            $table->string('key_name');
            $table->string('key_value');
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
