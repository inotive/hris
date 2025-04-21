<?php

namespace App\Http\Controllers;

use App\Helpers\AttendanceReportHelper;
use App\Models\Attendance;
use App\Models\Banner;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class AttendanceContrller extends Controller
{
    use CrudTrait;

    public $model = Attendance::class;
    public $route = 'attendances';
    public $page_title = 'Attendances';
    public $action_title = 'Attendance';


    public function report(Request $request)
    {
        if (!isset($request->filter['year'])) {
            return redirect()->route('attendance-report', [
                'filter'    => [
                    'month' => date('m'),
                    'year'  => date('Y'),
                ],
            ]);
            return;
        }
        $company_id = $request->filter['company_id'] ?? null;
        $year = $request->year ?? date('Y');
        $month = $request->month ?? date('m');

        if ($company_id) {

            $list = AttendanceReportHelper::report(
                company_id: $company_id,
                year: $year,
                month: $month,
            );
        } else {
            $list = [];
        }
        return view('attendances.report', [
            'list'  => $list,
            'year'  => $year,
            'month'  => $month,
        ]);
    }
}
