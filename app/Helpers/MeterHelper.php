<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MeterHelper
{
    /**
     * @param  int  $job_status_id
     * @param  int|null  $meter_id
     * @return float
     */
    public static function getStatusAverageDay(int $job_status_id, ?int $meter_id = 0): float
    {
        $sql_command = "
SELECT 
    `meter_id`, 
    SUM(`duration`) AS `sum_of_duration`, 
    AVG(SUM(`duration`)) over () AS `avg_duration_of_status`
FROM `job_status_durations`
WHERE 1";

        if ($job_status_id) {
            $sql_command .= " AND `job_status_id` = {$job_status_id}";
        }

        if ($meter_id) {
            $sql_command .= " AND `meter_id` = {$meter_id}";
        }

        $sql_command .= "
GROUP BY `meter_id`
ORDER BY SUM(`duration`) DESC
LIMIT 1;";

        $avg = DB::select($sql_command);
        return isset($avg[0]) ? round($avg[0]->avg_duration_of_status / 60 / 60 / 24, 2) : 0;
    }

    /**
     * @param  string  $base_url
     * @param  array|null  $param
     * @return string
     */
    public static function buildJobStatusFilterUrl(string $base_url, ?array $param = []): string
    {
        parse_str($_SERVER['QUERY_STRING'], $query_string);
        $query_string = array_merge($query_string, $param);
        return $base_url . '?' . http_build_query($query_string);
    }
}