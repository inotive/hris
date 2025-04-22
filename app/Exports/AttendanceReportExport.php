<?php

namespace App\Exports;

use App\Helpers\AttendanceReportHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceReportExport implements FromView
{
    use Exportable;

    public function __construct(public $company_id, public $year, public $month) {}

    public function view(): View
    {

        $list = AttendanceReportHelper::report(
            company_id: $this->company_id,
            year: $this->year,
            month: $this->month,
        );


        return view('exports.attendance-report',[
            'list'  => $list,
            'year'  => $this->year,
            'month' => $this->month,
        ]);
    }
}
