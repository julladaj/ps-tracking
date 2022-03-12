<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeElectricExpandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_expands', function (Blueprint $table) {
            $table->foreignId('geo_id')->change()->constrained('geos');
            $table->foreignId('env_earth_id')->change()->constrained('env_earths');
            $table->foreignId('env_tree_id')->change()->constrained('env_trees');
            $table->foreignId('reserved_forest_id')->change()->constrained('reserved_forests');
            $table->foreignId('env_community_id')->change()->constrained('env_communities');
            $table->foreignId('transformer_id')->nullable()->change()->constrained('transformers');
            $table->foreignId('station_id')->nullable()->change()->constrained('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('electric_expands', function (Blueprint $table) {
            $table->dropForeign('electric_expands_geo_id_foreign');
            $table->dropForeign('electric_expands_env_earth_id_foreign');
            $table->dropForeign('electric_expands_env_tree_id_foreign');
            $table->dropForeign('electric_expands_reserved_forest_id_foreign');
            $table->dropForeign('electric_expands_env_community_id_foreign');
            $table->dropForeign('electric_expands_transformer_id_foreign');
            $table->dropForeign('electric_expands_station_id_foreign');
        });

        Schema::table('electric_expands', function (Blueprint $table) {
            $table->string('geo_id')->nullable()->change();
            $table->string('env_earth_id')->nullable()->change();
            $table->string('env_tree_id')->nullable()->change();
            $table->string('reserved_forest_id')->nullable()->change();
            $table->string('env_community_id')->nullable()->change();
            $table->string('transformer_id')->nullable()->change();
            $table->string('station_id')->nullable()->change();
        });
    }
}
