<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceDetailResource;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();

        $list = Attendance::where('employee_id', $auth->id)
            ->orderBy('date','asc')
            ->get();


        return [
            'status'    => 'success',
            'data'  => $list,
        ];
    }


    public function detail(Request $request)
    {
        $auth = auth()->user();

        $date = request()->date ?? date('Y-m-d');

        $data = Attendance::where('employee_id', $auth->id)
            ->where('date', $date)
            ->first();


        return [
            'status'    => 'success',
            'data'  => new AttendanceDetailResource($data),
        ];
    }

    public function summary(Request $request)
    {
        $auth = auth()->user();

        $month = date('m');
        $year = date('Y');

        $absent = Attendance::where('employee_id', $auth->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->whereNotNull('clockin_time')
            ->whereNotNull('clockout_time')
            ->count();
       
       
        $no_clockin = Attendance::where('employee_id', $auth->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->whereNull('clockin_time')
            ->count();

              
        $no_clockout = Attendance::where('employee_id', $auth->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->whereNull('clockout_time')
            ->count();

        $late = Attendance::where('employee_id', $auth->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('clockin_status', 'LATE')
            ->count();

        $early = Attendance::where('employee_id', $auth->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('clockin_status', 'EARLY')
            ->count();
        
        return [
            'status'    => 'success',
            'data'      => [
                'absent'    => $absent,
                'late_clockin'  => $late,
                'early_clockin'  => $early,
                'no_clockin'  => $no_clockin,
                'no_clockout'  => $no_clockout,
            ],
        ];
    }
}
