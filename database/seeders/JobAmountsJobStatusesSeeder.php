<?php

namespace Database\Seeders;

use App\Models\JobAmounts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobAmountsJobStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['job_amount_id' => 1, 'job_status_id' => 1, 'standard_duration' => 1],
            ['job_amount_id' => 1, 'job_status_id' => 2, 'standard_duration' => 3],
            ['job_amount_id' => 1, 'job_status_id' => 3, 'standard_duration' => 2],
            ['job_amount_id' => 1, 'job_status_id' => 4, 'standard_duration' => 1],
            ['job_amount_id' => 1, 'job_status_id' => 5, 'standard_duration' => 1],

            ['job_amount_id' => 2, 'job_status_id' => 1, 'standard_duration' => 1],
            ['job_amount_id' => 2, 'job_status_id' => 2, 'standard_duration' => 4],
            ['job_amount_id' => 2, 'job_status_id' => 3, 'standard_duration' => 4],
            ['job_amount_id' => 2, 'job_status_id' => 4, 'standard_duration' => 1],
            ['job_amount_id' => 2, 'job_status_id' => 5, 'standard_duration' => 1],

            ['job_amount_id' => 3, 'job_status_id' => 1, 'standard_duration' => 1],
            ['job_amount_id' => 3, 'job_status_id' => 2, 'standard_duration' => 6],
            ['job_amount_id' => 3, 'job_status_id' => 3, 'standard_duration' => 6],
            ['job_amount_id' => 3, 'job_status_id' => 4, 'standard_duration' => 2],
            ['job_amount_id' => 3, 'job_status_id' => 5, 'standard_duration' => 1],

            ['job_amount_id' => 4, 'job_status_id' => 1, 'standard_duration' => 1],
            ['job_amount_id' => 4, 'job_status_id' => 2, 'standard_duration' => 11],
            ['job_amount_id' => 4, 'job_status_id' => 3, 'standard_duration' => 11],
            ['job_amount_id' => 4, 'job_status_id' => 4, 'standard_duration' => 2],
            ['job_amount_id' => 4, 'job_status_id' => 5, 'standard_duration' => 1],
        ];

        DB::table('job_amount_job_status')->insert($data);
    }
}
