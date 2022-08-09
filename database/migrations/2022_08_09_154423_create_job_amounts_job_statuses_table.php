<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAmountsJobStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_amounts_job_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_amounts_id')->constrained('job_amounts');
            $table->foreignId('job_statuses_id')->constrained('job_statuses');
            $table->tinyInteger('standard_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_amounts_job_statuses');
    }
}
