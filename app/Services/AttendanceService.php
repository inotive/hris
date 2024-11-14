<?php

namespace App\Services;

use App\Jobs\AttendanceInitJob;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    public static function init()
    {

        Employee::chunk(100, function ($items) {
            AttendanceInitJob::dispatch($items);
        });
    }

    public static function getListByEmployee($employee_id, $year, $month)
    {

        $date = Carbon::parse($year . "-" . $month . "-01");
        $list = DB::select("WITH RECURSIVE all_dates AS (
                    SELECT
                        DATE( '".$date->format('Y-m-01')."' ) AS DATE UNION ALL
                    SELECT DATE
                        + INTERVAL 1 DAY 
                    FROM
                        all_dates 
                    WHERE
                        DATE + INTERVAL 1 DAY <= DATE( '".$date->format('Y-m-t')."' ) 
                    ) SELECT
                    attendances.id,
                    all_dates.`date`,
                    IF
                    (
                        employee_shifts.id IS NOT NULL,
                        JSON_OBJECT( 'id', employee_shifts.id, 'name', employee_shifts.`name`, 'start_time', employee_shifts.start_time, 'end_time', employee_shifts.end_time ),
                        NULL 
                    ) AS shift,
                    IF
                    ( dayoff_table.id IS NULL, TRUE, FALSE ) is_day_off,
                    attendances.clockin_time,
                    attendances.clockin_status,
                    attendances.clockout_time,
                    attendances.clockout_status 
                    FROM
                    all_dates
                    LEFT JOIN ( SELECT employee_shift_day_offs.* FROM employee_shift_day_offs JOIN employees ON employees.employee_shift_id = employee_shift_day_offs.shift_id WHERE employees.id = '".$employee_id."' ) dayoff_table ON dayoff_table.`date` = all_dates.`date`
                    LEFT JOIN attendances ON attendances.`date` = all_dates.`date` 
                    AND attendances.employee_id = '".$employee_id."'
                    LEFT JOIN employee_shifts ON employee_shifts.id = attendances.employee_shift_id;");

        $list = collect($list)->map(function($row){
            $row->is_day_off = $row->is_day_off == 1 ? true : false;
            $row->shift = $row->shift != null ? json_decode($row->shift) : null;

            return $row;
        });
        return $list;
    }
}
