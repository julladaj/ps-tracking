<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->renameColumn('no_payment', 'has_payment');
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->float('payment_request')->default(0)->comment('เรียกเก็บจากผู้ใช้ไฟ');
            $table->integer('paid_credit_terms')->default(0)->comment('กำหนดยืนราคา');
            $table->boolean('paid')->default(false)->comment('ผู้ใช้ไฟได้ชำระ');
            $table->float('paid_amount')->default(0);
            $table->string('receive_no')->nullable()->comment('ใบเสร็จรับเงินเลขที่');
            $table->date('receive_date')->nullable()->comment('ลงวันที่ใบเสร็จรับเงิน');
            $table->foreignId('request_approve_user_id')->comment('ผู้เสนอขออนุมัติ')->nullable()->constrained('pea_staffs');
            $table->foreignId('approve_user_id')->comment('ผู้อนุมัติ')->nullable()->constrained('pea_staffs');
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
            $table->dropForeign('meters_request_approve_user_id_foreign');
            $table->dropForeign('meters_approve_user_id_foreign');
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->dropColumn([
                'payment_request',
                'paid_credit_terms',
                'paid',
                'paid_amount',
                'receive_no',
                'receive_date',
                'request_approve_user_id',
                'approve_user_id'
            ]);
        });

        Schema::table('meters', function (Blueprint $table) {
            $table->renameColumn('has_payment', 'no_payment');
        });
    }
}
