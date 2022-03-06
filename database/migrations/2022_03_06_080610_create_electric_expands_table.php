<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectricExpandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electric_expands', function (Blueprint $table) {
            $table->id();
            $table->string('job_name')->comment('ชื่องาน')->nullable();
            $table->string('location')->comment('สถานที่ใช้ไฟฟ้า')->nullable();
            $table->string('consumer_type')->comment('ลักษณะการใช้พลังงานไฟฟ้า')->nullable();
            $table->string('geo')->comment('สภาพภูมิประเทศ')->nullable();
            $table->string('env_earth')->comment('สภาพพื้นดิน')->nullable();
            $table->string('env_tree')->comment('สภาพต้นไม้ตามแนวขยายเขต')->nullable();
            $table->string('env_tree_distant_km')->comment('สภาพต้นไม้ตามแนวขยายเขต (กิโลเมตร)')->nullable();
            $table->string('reserved_forest')->comment('ป่าสงวน')->nullable();
            $table->string('working_with_car')->comment('นำรถยนต์เข้าปฏิบัติงาน')->nullable();
            $table->string('env_community')->comment('สภาพชุมชน')->nullable();
            $table->string('use_pea_transformer')->comment('รับพลังงานไฟฟ้าจากหม้อแปลง PEA')->nullable();
            $table->string('use_pea_transformer_size')->comment('หม้อแปลง PEA ขนาด')->nullable();
            $table->string('use_pea_transformer_type')->comment('หม้อแปลง PEA ระบบ')->nullable();
            $table->string('volt_from_station')->comment('โวลท์ จากสถานี')->nullable();
            $table->string('feeder')->comment('ฟีดเดอร์')->nullable();
            $table->string('feeder_distant_km')->comment('ระยะห่างจากสถานีตามระบบจำหน่าย (กิโลเมตร)')->nullable();
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
        Schema::dropIfExists('electric_expands');
    }
}
