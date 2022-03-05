<?php

namespace Database\Seeders;

use App\Models\JobAmounts;
use Illuminate\Database\Seeder;

class JobAmountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'ติดตั้งระบบจำหน่ายไม่เกิน ระยะทางไม่เกิน 250 เมตร'],
            ['description' => 'ติดตั้งระบบจำหน่ายไม่เกิน ระยะทางไม่เกิน 1,000 เมตร'],
            ['description' => 'ติดตั้งระบบจำหน่ายแรงสูงไม่เกิน 33 เควี ระยะทางไม่เกิน 500 เมตร'],
            ['description' => 'ติดตั้งระบบจำหน่ายแรงสูงไม่เกิน 33 เควี ระยะทางไม่เกิน 5,000 เมตร']
        ];

        JobAmounts::insert($data);
    }
}
