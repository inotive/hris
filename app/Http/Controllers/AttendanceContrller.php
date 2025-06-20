<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceReportExport;
use App\Helpers\AttendanceReportHelper;
use App\Models\Attendance;
use App\Models\Banner;
use App\Models\Company;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

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
        $company_id = $request->filter['company_id'] ?? auth()->user()->company_id ?? null;
        $year = $request->filter['year'] ?? date('Y');
        $month = $request->filter['month'] ?? date('m');

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


    public function export(Request $request)
    {
        $company_id = $request->company_id ?? null;
        $year = $request->year ?? date('Y');
        $month = $request->month ?? date('m');

        $company = Company::find($company_id);

        $filename = 'Attendance Report ' . Carbon::parse($year . '-' . $month . '-01')->format('M Y') . ' ' . ($company->name??'');

        return (new AttendanceReportExport(
            company_id: $company_id,
            year: $year,
            month: $month,
        ))->download($filename . '.xlsx');
    }
}
