<?php

namespace Database\Seeders;

use App\Models\EnvTrees;
use Illuminate\Database\Seeder;

class EnvTreesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'หนาทึบ'],
            ['description' => 'ไม่หนาทึบ']
        ];

        EnvTrees::insert($data);
    }
}
