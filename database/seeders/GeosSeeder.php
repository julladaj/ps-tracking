<?php

namespace Database\Seeders;

use App\Models\Geos;
use Illuminate\Database\Seeder;

class GeosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'ที่ราบปกติ'],
            ['description' => 'ที่ลุ่มมีน้ำขัง'],
            ['description' => 'ลำน้ำคูคลอง'],
            ['description' => 'ภูเขา-หิน']
        ];

        Geos::insert($data);
    }
}
