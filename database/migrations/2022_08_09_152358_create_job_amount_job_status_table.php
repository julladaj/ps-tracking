<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobAmountJobStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_amount_job_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_amount_id')->constrained('job_amounts');
            $table->foreignId('job_status_id')->constrained('job_statuses');
            $table->tinyInteger('standard_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_amount_job_status');
    }
}
