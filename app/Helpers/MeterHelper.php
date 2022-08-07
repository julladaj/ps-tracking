<?php

namespace App\Helpers;

use App\Models\JobStatusDurations;
use App\Models\Meters;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
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
//        $ds = new Carbon('2022-05-25 02:41:47');
//        $de = new Carbon('2022-06-24 02:35:24');
//        dd($ds->diffInSeconds($de));

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

        $duration = isset($avg[0]) ? round($avg[0]->avg_duration_of_status, 2) : 0;
        if (!$duration && $meter && $meter->job_status_id === $job_status_id) {
            $last_step = JobStatusDurations::select('created_at')
                ->where('meter_id', $meter->id)
                ->where('job_status_id', $job_status_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($last_step) {
                $duration = self::calculateDurationWithoutWeekend($last_step->created_at, now());
            } else {
                $duration = self::calculateDurationWithoutWeekend($meter->created_at, now());
            }
        }
        return ceil($duration / 60 / 60 / 24);
    }

    public static function recalculateJobStatusDurations()
    {
        $rowEffected = 0;
        $meters = Meters::all('id');

        foreach ($meters as $meter) {
            $jobStatusDurations = JobStatusDurations::where('meter_id', $meter->id)
                ->orderBy('id')
                ->get(['id', 'created_at']);

            $dtStart = null;
            $dtEnd = null;
            $lastRecordId = null;

            foreach ($jobStatusDurations as $jobStatusDuration) {
                if (!$dtStart) {
                    $dtStart = $jobStatusDuration->created_at;
                    $lastRecordId = $jobStatusDuration->id;
                    continue;
                }
                $dtEnd = $jobStatusDuration->created_at;
                $duration = self::calculateDurationWithoutWeekend($dtStart, $dtEnd);
                JobStatusDurations::where('id', $lastRecordId)
                    ->update(['duration' => $duration]);
                $rowEffected++;
                $dtStart = $dtEnd;
                $lastRecordId = $jobStatusDuration->id;
            }
        }
        return $rowEffected;
    }

    /**
     * @param  Carbon  $dtStart
     * @param  Carbon  $dtEnd
     * @return int
     */
    private static function calculateDurationWithoutWeekend(Carbon $dtStart, Carbon $dtEnd): int
    {
        $secondDuration = 0;
        $dStart = $dtStart->format('Y-m-d');
        $dEnd = $dtEnd->format('Y-m-d');
        // addDays modify origin, so make copy of origin and then using it.
        $dEndAddDay = $dtEnd->copy();
        $period = new DatePeriod($dtStart, new DateInterval('P1D'), $dEndAddDay->addDays(1));

        foreach ($period as $dt) {
            if (!self::isWeekday($dt)) {
                continue;
            }

            $startDateTime = new Carbon($dt->format('Y-m-d 00:00'));
            $endDateTime = new Carbon($dt->copy()->addDays(1)->format('Y-m-d 00:00'));
            if ($dt->format('Y-m-d') === $dStart) {
                $startDateTime = $dtStart;
            }
            if ($dt->format('Y-m-d') === $dEnd) {
                $endDateTime = $dtEnd;
                $secondDuration += $startDateTime->diffInSeconds($endDateTime);
                break;
            }

            $secondDuration += $startDateTime->diffInSeconds($endDateTime);
        }
        return $secondDuration;
    }

    /**
     * @param  \DateTime  $date
     * @return bool
     */
    public static function isWeekday(\DateTime $date): bool
    {
        return $date->format('N') < 6;
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