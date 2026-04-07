<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceDetailResource;
use App\Models\Attendance;
use App\Models\Employee;
use App\Services\AttendanceService;
use App\Services\Base64FileService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        $auth = auth()->user();

        // $list = Attendance::where('employee_id', $auth->id)
        //     ->when($request->start_date != null && $request->end_date != null, function ($q) use ($request) {
        //         return $q->where('date', '>=', $request->start_date)->where('date', '<=', $request->start_date);
        //     })
        //     ->when($request->month != null, function ($query) use ($request) {
        //         return $query->whereMonth('date', $request->month);
        //     })
        //     ->when($request->year != null, function ($query) use ($request) {
        //         return $query->whereYear('date', $request->year);
        //     })
        //     ->orderBy('created_at', $request->sort ?? 'desc')
        //     ->paginate($request->per_page ?? 10);


        // $pagination = $list->toArray();
        // unset($pagination['data']);

        $list = AttendanceService::getListByEmployee($auth->id, $request->year, $request->month);
        return [
            'status' => 'success',
            'data' => ($list)->map(function ($row) {

                $row->clockin_image = isset($row->clockin_image) ? asset($row->clockin_image) : null;
                $row->clockout_image = isset($row->clockout_image) ? asset($row->clockout_image) : null;


                return $row;
            }),
            // 'pagination' => $pagination,
        ];
    }


    public function detail(Request $request)
    {
        $auth = auth()->user();

        $date = request()->date ?? date('Y-m-d');

        $data = Attendance::where('employee_id', $auth->id)
            ->where('date', $date)
            ->first() ?? Attendance::create([
                'employee_id' => $auth->id,
                'employee_shift_id' => $auth->employee_shift_id,
                'date' => $date,

            ]);

        if ($data == null) {
            return [
                'status' => 'success',
                'data' => null,
            ];
        } else {
            return [
                'status' => 'success',
                'data' => new AttendanceDetailResource($data),
            ];
        }


    }

    public function clockin(Request $request)
    {
        $auth = auth()->user();

        // Gunakan timezone dari pengaturan perusahaan
        // Admin mengatur time_zone perusahaan di panel admin (Asia/Jakarta / Asia/Makassar / Asia/Jayapura)
        $tz  = $auth->company->time_zone ?? 'UTC';
        $now = Carbon::now($tz);
        $today = $now->format('Y-m-d');

        $attendance = Attendance::where('employee_id', $auth->id)
            ->where('date', $today)
            ->first() ?? new Attendance([
            'employee_id' => $auth->id,
            'date' => $today,
        ]);

        if ($attendance->clockin_time != null) {
            return [
                'status' => 'error',
                'message' => 'Already clocked in',
            ];
        }

        $is_attendance_location = $auth->is_attendance_location ?? false;

        // if is attendance location true 
        // then check location by company latitude longitude
        if ($is_attendance_location) {
            $lat = $auth->company->lat;
            $lng = $auth->company->lng;

            $distance = AttendanceService::getDistance($request->clockin_lat, $request->clockin_long, $lat, $lng);

            if ($distance > 500) {
                // return response()->json([
                //     'status' => 'error',
                //     'message' => 'You are not in the attendance location',
                // ], 200);

                $attendance->clockin_range_status = 'OUT';
            } else {
                $attendance->clockin_range_status = 'IN';
            }
        }


        $image = Base64FileService::saveBase64File($request->clockin_image, 'attendance_clockin');


        // Waktu dari server berdasarkan zona GPS — tidak bisa dimanipulasi user
        $attendance->clockin_time = $now->format('H:i:s');
        $attendance->clockin_lat = $request->clockin_lat;
        $attendance->clockin_long = $request->clockin_long;
        $attendance->clockin_image = $image;

        $attendance->save();


        return [
            'status' => 'success',
            'message' => "Clockin submited, data save successful"
        ];
    }

    public function clockout(Request $request)
    {
        $auth = auth()->user();

        // Gunakan timezone dari pengaturan perusahaan
        $tz  = $auth->company->time_zone ?? 'UTC';
        $now = Carbon::now($tz);
        $today = $now->format('Y-m-d');


        // $request->validate([
        //     'clockout_time'  => 'required',
        //     'clockout_lat'  => 'required',
        //     'clockout_long'  => 'required',
        //     'clockout_image'  => 'required',
        // ]);

        $attendance = Attendance::where('employee_id', $auth->id)
            ->where('date', $today)
            ->first();

        if ($attendance == null) {
            return [
                'status' => 'error',
                'message' => 'You have not checked in today',
            ];
        }

        if ($attendance->clockout_time != null) {
            return [
                'status' => 'error',
                'message' => 'Already clocked out',
            ];
        }


        $is_attendance_location = $auth->is_attendance_location ?? false;

        // if is attendance location true 
        // then check location by company latitude longitude
        if ($is_attendance_location) {
            $lat = $auth->company->lat;
            $lng = $auth->company->lng;

            $distance = AttendanceService::getDistance($request->clockout_lat, $request->clockout_long, $lat, $lng);

            if ($distance > 500) {
                // return response()->json([
                //     'status' => 'error',
                //     'message' => 'You are not in the attendance location',
                // ], 200);

                $attendance->clockout_range_status = 'OUT';
            } else {
                $attendance->clockout_range_status = 'IN';
            }
        }

        $image = Base64FileService::saveBase64File($request->clockout_image, 'attendance_clockin');


        if ($attendance != null) {
            // Waktu dari server berdasarkan zona GPS — tidak bisa dimanipulasi user
            $attendance->clockout_time = $now->format('H:i:s');
            $attendance->clockout_lat = $request->clockout_lat;
            $attendance->clockout_long = $request->clockout_long;
            $attendance->clockout_image = $image;
            $attendance->save();
        }

        return [
            'status' => 'success',
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
            'status' => 'success',
            'data' => [
                'absent' => $absent,
                'late_clockin' => $late,
                'early_clockin' => $early,
                'no_clockin' => $no_clockin,
                'no_clockout' => $no_clockout,
            ],
        ];
    }


    public function monthList()
    {
        $months = Attendance::monthDropdown();

        return [
            'status' => 'success',
            'data' => $months,
        ];
    }

    public function yearList()
    {

        $years = Attendance::yearDropdown();


        return [
            'status' => 'success',
            'data' => $years,
        ];
    }
}
