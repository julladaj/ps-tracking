<?php

namespace Database\Seeders;

use App\Models\Transformers;
use Illuminate\Database\Seeder;

class TransformersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => '30 kVA'],
            ['description' => '50 kVA'],
            ['description' => '100 kVA'],
            ['description' => '160 kVA'],
            ['description' => '250 kVA'],
            ['description' => '315 kVA'],
            ['description' => '400 kVA'],
            ['description' => '500 kVA'],
            ['description' => '630 kVA'],
            ['description' => '800 kVA'],
            ['description' => '1000 kVA']
        ];

        Transformers::insert($data);
    }
}
