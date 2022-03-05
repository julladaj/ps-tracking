<?php

namespace Database\Seeders;

use App\Models\JobStatuses;
use Illuminate\Database\Seeder;

class JobStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'รอดำเนินการ'],
            ['description' => 'สำรวจ'],
            ['description' => 'จัดทำแผนผัง/ประมาณการค่าใช้จ่าย'],
            ['description' => 'อนุมัติ/แจ้งค่าใช้จ่าย'],
            ['description' => 'รับชำระเงิน']
        ];

        JobStatuses::insert($data);
    }
}
