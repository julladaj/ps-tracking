<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenancyToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->foreignId('pea_id')
                ->after('id')
                ->default(1)
                ->constrained('peas');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('pea_id')
                ->after('id')
                ->default(1)
                ->constrained('peas');
        });
        Schema::table('pea_staffs', function (Blueprint $table) {
            $table->foreignId('pea_id')
                ->after('id')
                ->default(1)
                ->constrained('peas');
        });
        Schema::table('stations', function (Blueprint $table) {
            $table->foreignId('pea_id')
                ->after('id')
                ->default(1)
                ->constrained('peas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->dropColumn(['pea_id']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pea_id']);
        });
        Schema::table('pea_staffs', function (Blueprint $table) {
            $table->dropColumn(['pea_id']);
        });
        Schema::table('stations', function (Blueprint $table) {
            $table->dropColumn(['pea_id']);
        });
    }
}
