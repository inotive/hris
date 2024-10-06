<?php

namespace App\Services;

use App\Jobs\AttendanceInitJob;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    public static function init()
    {

        Employee::where('status', 1)->chunk(100, function ($items) {
            AttendanceInitJob::dispatch($items);
        });
    }
}