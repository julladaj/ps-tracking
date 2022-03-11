<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MeterHelper
{
    /**
     * @param  int  $job_status_id
     * @return float
     */
    public static function getStatusAverageDay(int $job_status_id): float
    {
        $sql_command = <<<SQL
SELECT 
    `meter_id`, 
    SUM(`duration`) AS `sum_of_duration`, 
    AVG(SUM(`duration`)) over () AS `avg_duration_of_status`
FROM `job_status_durations` 
SQL;

        if ($job_status_id) {
            $sql_command .= <<<SQL
WHERE `job_status_id` = {$job_status_id} 
SQL;
        }

        $sql_command .= <<<SQL
GROUP BY `meter_id`
ORDER BY SUM(`duration`) DESC
LIMIT 1;
SQL;

        $avg = DB::select($sql_command);
        return isset($avg[0]) ? round($avg[0]->avg_duration_of_status / 60 / 60 / 24, 2) : 0;
    }

    /**
     * @param  string  $base_url
     * @param  int  $job_status_id
     * @return string
     */
    public static function buildJobStatusFilterUrl(string $base_url, int $job_status_id): string
    {
        parse_str($_SERVER['QUERY_STRING'], $query_string);
        $query_string = array_merge($query_string, [
            'job_status_id' => $job_status_id
        ]);
        return $base_url . '?' . http_build_query($query_string);
    }
}