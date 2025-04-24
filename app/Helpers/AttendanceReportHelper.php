<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceReportHelper
{
    public static function report($company_id, $year, $month)
    {


        $date = Carbon::parse($year . "-" . $month . "-01");

        

        $start = $date->format('Y-m-d');

        $end_str = $date->format('Y-m-t');

        $selects = [];

        $days = range(1, (int) $date->format("t"));


        foreach ($days as $day) {
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_time END) AS day" . $day . "_in_time";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_image END) AS day" . $day . "_in_image";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_lat END) AS day" . $day . "_in_lat";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_long END) AS day" . $day . "_in_long";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_status END) AS day" . $day . "_in_status";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockin_range_status END) AS day" . $day . "_in_range_status";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_time END) AS day" . $day . "_out_time";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_image END) AS day" . $day . "_out_image";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_lat END) AS day" . $day . "_out_lat";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_long END) AS day" . $day . "_out_long";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_status END) AS day" . $day . "_out_status";
            $selects[] = "MAX(CASE WHEN DAY(a.date) = " . $day . " THEN a.clockout_range_status END) AS day" . $day . "_out_range_status";
        }


        $query = "SELECT 
            a.employee_id,
            e.nik,
            concat(e.first_name,e.last_name) AS employee_name,
            e.image AS employee_image,
            employee_departments.name AS department_name,
            employee_positions.name AS position_name,
            " . max($days) . " as total_day,


            " . implode(",", $selects) . "

        FROM 
            attendances a
        JOIN 
            employees e ON a.employee_id = e.id
        LEFT JOIN employee_departments ON employee_departments.id = e.department_id
        LEFT JOIN employee_positions ON employee_positions.id = e.employee_position_id
        WHERE 
            a.date BETWEEN '" . $start . "' AND '" . $end_str . "'
            AND a.company_id = '" . $company_id . "'
        GROUP BY 
            a.employee_id;
        ";

      

        $list = DB::select($query);

        $list = collect($list)->map(function ($row) use ($days) {

            foreach ($days as $day) {
                $clockin_status = "day" . $day . "_in_status";
                $clockin_status_code = $clockin_status . "_code";

                $clockout_status = "day" . $day . "_out_status";
                $clockout_status_code = $clockout_status . "_code";


                $row->$clockin_status_code = $row->$clockin_status != null ? ($row->$clockin_status == "LATE" ? "LIN" : "PRS") : null;
                $row->$clockout_status_code = $row->$clockout_status != null ? ($row->$clockout_status == "EARLY" ? "EOT" : "PRS") : null;
            
                $dates = 'day' . $day . '_dates';
                $date_1 = 'day' . $day . '_in_time';
                $date_2 = 'day' . $day . '_out_time';
                $row->$dates = ($row->$date_1 != null ? Carbon::parse($row->$date_1)->format('H:m') : '-') . '/' . ($row->$date_2 != null ? Carbon::parse($row->$date_2)->format('H:m') : '-'); 
            }
            return $row;
        })->collect();

      


        return $list;
    }
}
