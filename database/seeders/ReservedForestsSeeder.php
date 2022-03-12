<?php

namespace Database\Seeders;

use App\Models\ReservedForests;
use Illuminate\Database\Seeder;

class ReservedForestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'มี'],
            ['description' => 'ไม่มี']
        ];

        ReservedForests::insert($data);
    }
}
