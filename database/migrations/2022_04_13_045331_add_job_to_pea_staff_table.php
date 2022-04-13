<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobToPeaStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pea_staffs', function (Blueprint $table) {
            $table->string('job_title')->nullable();
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pea_staffs', function (Blueprint $table) {
            $table->dropColumn([
                'job_title',
                'position'
            ]);
        });
    }
}
