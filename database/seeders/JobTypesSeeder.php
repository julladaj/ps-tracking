<?php

namespace Database\Seeders;

use App\Models\JobTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'ปักเสาบริการ'],
            ['description' => 'ขยายเขตระบบจำหน่ายแรงต่ำ 1 เฟส'],
            ['description' => 'ขยายเขตระบบจำหน่ายแรงต่ำ 3 เฟส'],
            ['description' => 'ขยายเขตระบบจำหน่ายแรงสูง 1 เฟส'],
            ['description' => 'ขยายเขตระบบจำหน่ายแรงสูง 3 เฟส'],
            ['description' => 'ขยายเขตระบบจำหน่าย (คฟม.2)'],
            ['description' => 'ขยายเขตระบบจำหน่าย (คขก. ช่องปี 2565-2566)'],
            ['description' => 'ขยายเขตระบบจำหน่ายที่ดินแบ่งขาย'],
            ['description' => 'ขยายเขตระบบจำหน่ายที่ดินจัดสรร'],
            ['description' => 'ย้ายแนวเสาและ/หรืออุปกรณ์ต่างๆ']
        ];

        JobTypes::insert($data);
    }
}
