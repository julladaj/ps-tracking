<?php

namespace Database\Seeders;

use App\Models\EnvEarths;
use Illuminate\Database\Seeder;

class EnvEarthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'ดินธรรมดา'],
            ['description' => 'ดินทราย'],
            ['description' => 'เขาดินลูกรัง'],
            ['description' => 'ภูเขา-หิน'],
            ['description' => 'ดินดาน']
        ];

        EnvEarths::insert($data);
    }
}
