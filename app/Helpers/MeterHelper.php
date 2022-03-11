<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MeterHelper
{
    public static function getStatusAverageDay($job_status_id)
    {
        $sql_command = <<<SQL
SELECT 
    `meter_id`, 
    SUM(`duration`) AS `sum_of_duration`, 
    AVG(SUM(`duration`)) over () AS `avg_duration_of_status`
FROM `job_status_durations`
WHERE `job_status_id` = {$job_status_id}
GROUP BY `meter_id`
ORDER BY SUM(`duration`) DESC
LIMIT 1;
SQL;

        $avg = DB::select($sql_command);
        return isset($avg[0]) ? round($avg[0]->avg_duration_of_status / 60 / 60 / 24, 2) : 0;
    }
}