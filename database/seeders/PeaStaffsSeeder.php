<?php

namespace Database\Seeders;

use App\Models\PeaStaffs;
use Illuminate\Database\Seeder;

class PeaStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'นายเทพฤทธิ์ แบ่งทิศ'],
            ['name' => 'นายพิพัฒพงษ์ ลิตาพัณณ์'],
            ['name' => 'นายชาคริต คำมูล']
        ];

        PeaStaffs::insert($data);
    }
}
