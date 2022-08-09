<?php

namespace Database\Seeders;

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
            ['job_amounts_id' => 1, 'job_statuses_id' => 1, 'standard_duration' => 1],
            ['job_amounts_id' => 1, 'job_statuses_id' => 2, 'standard_duration' => 3],
            ['job_amounts_id' => 1, 'job_statuses_id' => 3, 'standard_duration' => 2],
            ['job_amounts_id' => 1, 'job_statuses_id' => 4, 'standard_duration' => 1],
            ['job_amounts_id' => 1, 'job_statuses_id' => 5, 'standard_duration' => 1],

            ['job_amounts_id' => 2, 'job_statuses_id' => 1, 'standard_duration' => 1],
            ['job_amounts_id' => 2, 'job_statuses_id' => 2, 'standard_duration' => 4],
            ['job_amounts_id' => 2, 'job_statuses_id' => 3, 'standard_duration' => 4],
            ['job_amounts_id' => 2, 'job_statuses_id' => 4, 'standard_duration' => 1],
            ['job_amounts_id' => 2, 'job_statuses_id' => 5, 'standard_duration' => 1],

            ['job_amounts_id' => 3, 'job_statuses_id' => 1, 'standard_duration' => 1],
            ['job_amounts_id' => 3, 'job_statuses_id' => 2, 'standard_duration' => 6],
            ['job_amounts_id' => 3, 'job_statuses_id' => 3, 'standard_duration' => 6],
            ['job_amounts_id' => 3, 'job_statuses_id' => 4, 'standard_duration' => 2],
            ['job_amounts_id' => 3, 'job_statuses_id' => 5, 'standard_duration' => 1],

            ['job_amounts_id' => 4, 'job_statuses_id' => 1, 'standard_duration' => 1],
            ['job_amounts_id' => 4, 'job_statuses_id' => 2, 'standard_duration' => 11],
            ['job_amounts_id' => 4, 'job_statuses_id' => 3, 'standard_duration' => 11],
            ['job_amounts_id' => 4, 'job_statuses_id' => 4, 'standard_duration' => 2],
            ['job_amounts_id' => 4, 'job_statuses_id' => 5, 'standard_duration' => 1],
        ];

        DB::table('job_amounts_job_statuses')->insert($data);
    }
}
