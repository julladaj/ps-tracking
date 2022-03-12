<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFieldsElectricExpandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('electric_expands', function (Blueprint $table) {
            $table->renameColumn('geo', 'geo_id');
            $table->renameColumn('env_earth', 'env_earth_id');
            $table->renameColumn('env_tree', 'env_tree_id');
            $table->renameColumn('reserved_forest', 'reserved_forest_id');
            $table->renameColumn('env_community', 'env_community_id');
            $table->renameColumn('use_pea_transformer', 'transformer_pea_no');
            $table->renameColumn('use_pea_transformer_size', 'transformer_id');
            $table->renameColumn('use_pea_transformer_type', 'transformer_type');
            $table->renameColumn('volt_from_station', 'station_id');
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
            $table->renameColumn('geo_id', 'geo');
            $table->renameColumn('env_earth_id', 'env_earth');
            $table->renameColumn('env_tree_id', 'env_tree');
            $table->renameColumn('reserved_forest_id', 'reserved_forest');
            $table->renameColumn('env_community_id', 'env_community');
            $table->renameColumn('transformer_pea_no', 'use_pea_transformer');
            $table->renameColumn('transformer_id', 'use_pea_transformer_size');
            $table->renameColumn('transformer_type', 'use_pea_transformer_type');
            $table->renameColumn('station_id', 'volt_from_station');
        });
    }
}
