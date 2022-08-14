<?php

namespace Database\Seeders;

use App\Models\Peas;
use Illuminate\Database\Seeder;

class PeasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'การไฟฟ้าส่วนภูมิภาคอำเภอหางดง',
                'short_name' => 'กฟอ.หางดง',
                'address' => '197 หมู่ 8 ตำบลหนองแก๋ว อำเภอหางดง จังหวัดเชียงใหม่ 50230'
            ],
        ];

        Peas::insert($data);
    }
}
