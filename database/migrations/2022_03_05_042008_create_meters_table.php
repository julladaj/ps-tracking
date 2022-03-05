<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meters', function (Blueprint $table) {
            $table->id();
            $table->string('document_number', 20)->comment('เลขที่คำร้อง');
            $table->timestamp('document_date')->comment('วันที่ยื่นคำร้อง')->useCurrent();
            $table->string('customer_name')->comment('ชื่อลูกค้า');
            $table->string('customer_phone', 20)->comment('เบอร์โทรลูกค้า')->nullable();
            $table->string('job_number', 20)->comment('หมายเลขงาน')->nullable();
            $table->foreignId('job_amount_id')->comment('ปริมาณงาน')->constrained('job_amounts');
            $table->foreignId('job_status_id')->comment('สถานะงาน')->constrained('job_statuses');
            $table->foreignId('job_type_id')->comment('ประเภทงาน')->constrained('job_types');
            $table->foreignId('transformer_id')->comment('หม้อแปลง')->constrained('transformers');
            $table->foreignId('survey_user_id')->comment('ชื่อผู้สำรวจ')->nullable()->constrained('pea_staffs');
            $table->string('comment')->comment('หมายเหตุ')->nullable();
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
        Schema::dropIfExists('meters');
    }
}
