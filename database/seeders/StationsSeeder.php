<?php

namespace Database\Seeders;

use App\Models\Stations;
use Illuminate\Database\Seeder;

class StationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'เชียงใหม่ 3'],
            ['description' => 'สันป่าตอง'],
            ['description' => 'พืชสวนโลก']
        ];

        Stations::insert($data);
    }
}
