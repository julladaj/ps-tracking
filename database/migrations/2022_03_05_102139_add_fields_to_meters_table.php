<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->string('approve_location')->comment('อนุมัติที่')->nullable()->after('survey_user_id');
            $table->date('approve_date')->comment('ลงวันที่อนุมัติ')->nullable()->after('survey_user_id');
            $table->date('expires_quote_date')->comment('หมดกำหนดยื่นราคา')->nullable()->after('survey_user_id');
            $table->date('payment_date')->comment('วันที่ชำระเงิน')->nullable()->after('survey_user_id');
            $table->date('service_final_date')->comment('วันที่ชำระเงิน')->nullable()->after('survey_user_id');
            $table->boolean('no_payment')->comment('ไม่มีค่าใช้จ่ายเรียกเก็บจากผู้ใช้ไฟ')->default(false)->after('survey_user_id');
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
            $table->dropColumn([
                'approve_location',
                'approve_date',
                'expires_quote_date',
                'payment_date',
                'service_final_date',
                'no_payment'
            ]);
        });
    }
}
