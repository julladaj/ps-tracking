<?php

namespace Database\Seeders;

use App\Models\PaymentRates;
use Illuminate\Database\Seeder;

class PaymentRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'ประเภทที่ 1 บ้านอยู่อาศัย', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 2 กิจการขนาดเล็ก', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 3 กิจการขนาดกลาง', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 4 กิจการขนาดใหญ่', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 5 กิจการเฉพาะอย่าง', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 6 องค์กรที่ไม่แสวงหากำไร', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 7 สูบน้ำเพื่อการเกษตร ', 'payment_factor' => 1],
            ['description' => 'ประเภทที่ 8 ไฟฟ้าชั่วคราว', 'payment_factor' => 2]
        ];

        PaymentRates::insert($data);
    }
}
