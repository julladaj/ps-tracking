<?php

namespace App\Helpers;

use App\Models\JobStatusDurations;
use App\Models\Meters;
use Illuminate\Support\Facades\DB;

class MeterHelper
{
    /**
     * @param  int  $job_status_id
     * @param  Meters|null  $meter
     * @return float
     */
    public static function getStatusAverageDay(int $job_status_id, ?Meters $meter = null): float
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

        if ($meter_id = optional($meter)->id) {
            $sql_command .= " AND `meter_id` = {$meter_id}";
        }

        $sql_command .= "
GROUP BY `meter_id`
ORDER BY SUM(`duration`) DESC
LIMIT 1;";

        $avg = DB::select($sql_command);

        $duration = isset($avg[0]) ? round($avg[0]->avg_duration_of_status / 60 / 60 / 24, 2) : 0;
        if (!$duration && $meter && $meter->job_status_id === $job_status_id) {
            $last_step = JobStatusDurations::select('created_at')
                ->where('meter_id', $meter->id)
                ->where('job_status_id', $job_status_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($last_step) {
                $duration = round(optional($last_step->created_at)->diffInSeconds(now()) / 60 / 60 / 24, 2);
            } else {
                $duration = round(optional($meter->created_at)->diffInSeconds(now()) / 60 / 60 / 24, 2);
            }
        }
        return $duration;
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