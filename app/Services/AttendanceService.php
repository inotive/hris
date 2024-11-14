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

        $list = DB::select("SELECT
                attendances.id,
                attendances.`date`,
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
                attendances
                LEFT JOIN ( SELECT employee_shift_day_offs.* FROM employee_shift_day_offs JOIN employees ON employees.employee_shift_id = employee_shift_day_offs.shift_id WHERE employees.id = '9d487f62-6b26-4599-b95c-094b8a1bfac0' ) dayoff_table ON dayoff_table.`date` = attendances.`date`
                LEFT JOIN employee_shifts ON employee_shifts.id = attendances.employee_shift_id 
                WHERE
                attendances.employee_id = '9d487f62-6b26-4599-b95c-094b8a1bfac0' 
                AND YEAR( attendances.DATE ) = '".$year."' 
                AND MONTH( attendances.DATE ) = '".$month."'");

        $list = collect($list)->map(function($row){
            $row->is_day_off = $row->is_day_off == 1 ? true : false;
            $row->shift = $row->shift != null ? json_decode($row->shift) : null;

            return $row;
        });
        return $list;
    }
}
