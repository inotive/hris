<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    public static function init()
    {
        $date = date('Y-m-d');
        $inserts = Employee::get()->map(function($row) use ($date){
            return [
                'employee_id'   => $row->id,
                'employee_shift_id'   => $row->employee_shift_id,
                'date'  => $date,
            ];
        });

        foreach($inserts as $key => $value) {
            Attendance::firstOrCreate($value);
        }
    }
}