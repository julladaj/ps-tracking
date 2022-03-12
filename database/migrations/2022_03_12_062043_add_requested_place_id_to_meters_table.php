<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestedPlaceIdToMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->foreignId('requested_place_id')->nullable()->comment('สถานที่ขอใช้บริการ')->after('transformer_id')->constrained('requested_places');
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
            $table->dropForeign('meters_requested_place_id_foreign');
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->dropColumn([
                'requested_place_id'
            ]);
        });
    }
}
