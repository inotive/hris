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
            ->when($request->start_date != null && $request->end_date != null, function ($q) use ($request) {
                return $q->where('date', '>=', $request->start_date)->where('date', '<=', $request->start_date);
            })
            ->when($request->month != null, function ($query) use ($request) {
                return $query->whereMonth('date', $request->month);
            })
            ->when($request->year != null, function ($query) use ($request) {
                return $query->whereYear('date', $request->year);
            })
            ->orderBy('created_at', $request->sort ?? 'desc')
            ->paginate();


        $pagination = $list->toArray();
        unset($pagination['data']);
        return [
            'status'    => 'success',
            'data'  => AttendanceDetailResource::collection($list),
            'pagination' => $pagination,
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

    public function clockin(Request $request)
    {
        $auth = auth()->user();

        $date = date('Y-m-d');

        $request->validate([
            'clockin_time'  => 'required',
            'clockin_lat'  => 'required',
            'clockin_long'  => 'required',
        ]);

        $attendance = Attendance::where('employee_id', $auth->id)
            ->where('date', $date)
            ->first() ?? new Attendance([
                'employee_id'   => $auth->id,
                'date'  => $date,
            ]);

        $attendance->clockin_time = $request->clockin_time;
        $attendance->clockin_lat = $request->clockin_lat;
        $attendance->clockin_long = $request->clockin_long;
        $attendance->save();


        return [
            'status'    => 'success',
            'message' => "Clockin submited, data save successful"
        ];
    }

    public function clockout(Request $request)
    {
        $auth = auth()->user();

        $date = date('Y-m-d');

        $request->validate([
            'clockout_time'  => 'required',
            'clockout_lat'  => 'required',
            'clockout_long'  => 'required',
        ]);

        $attendance = Attendance::where('employee_id', $auth->id)
            ->where('date', $date)
            ->first();

        if ($attendance != null) {
            $attendance->clockout_time = $request->clockout_time;
            $attendance->clockout_lat = $request->clockuot_lat;
            $attendance->clockout_long = $request->clockout_long;
            $attendance->save();
        }

        return [
            'status'    => 'success',
            'message' => "Clockout submited, data save successful"
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


    public function monthList()
    {
        $months = [
            ['key' => '1', 'value' => __('January')],
            ['key' => '2', 'value' => __('February')],
            ['key' => '3', 'value' => __('March')],
            ['key' => '4', 'value' => __('April')],
            ['key' => '5', 'value' => __('May')],
            ['key' => '6', 'value' => __('June')],
            ['key' => '7', 'value' => __('July')],
            ['key' => '8', 'value' => __('August')],
            ['key' => '9', 'value' => __('September')],
            ['key' => '10', 'value' => __('October')],
            ['key' => '11', 'value' => __('November')],
            ['key' => '12', 'value' => __('December')],
        ];
        
        return [
            'status'    => 'success',
            'data'  => $months,
        ];
    }

    public function yearList()
    {
        $years = [];
        for($i = date('Y') - 1; $i <= date('Y') + 5; $i++) {
            $years[] = [
                'key'   => $i,
                'value' => $i,
            ];
        }


        return [
            'status'    => 'success',
            'data'  => $years,
        ];
    }
}
