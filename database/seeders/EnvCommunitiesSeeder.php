<?php

namespace Database\Seeders;

use App\Models\EnvCommunities;
use Illuminate\Database\Seeder;

class EnvCommunitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'หนาแน่น'],
            ['description' => 'ไม่หนาแน่น']
        ];

        EnvCommunities::insert($data);
    }
}
