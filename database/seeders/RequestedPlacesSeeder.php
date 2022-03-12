<?php

namespace Database\Seeders;

use App\Models\RequestedPlaces;
use Illuminate\Database\Seeder;

class RequestedPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'เอกชน', 'credit_terms' => 90],
            ['description' => 'ราชการ', 'credit_terms' => 180],
            ['description' => 'รัฐวิสาหกิจ', 'credit_terms' => 90],
            ['description' => 'รัฐวิสาหกิจ (ขยายกำหนดยืนราคา)', 'credit_terms' => 180]
        ];

        RequestedPlaces::insert($data);
    }
}
