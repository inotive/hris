<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\EmployeePayslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PayslipHelper
{
    public function view($id)
    {
        $payslip = EmployeePayslip::find($id);
        $period = Carbon::parse($payslip->year . '-' . $payslip->month  . '-01')->format('F Y');
        $pdf = Pdf::loadView('payslip.payslip', [
            'payslip' => $payslip,
            'period' => $period,
            'employee'  => $payslip->employee,
            'company'   => $payslip->company,
        ]);

        

        return $pdf->stream('payslip-' . $payslip->employee->fullname . '-' . $period . '.pdf');
    }

    public function print($id)
    {
        $payslip = EmployeePayslip::find($id);
        $period = Carbon::parse($payslip->year . '-' . $payslip->month  . '-01')->format('F Y');
        $pdf = Pdf::loadView('payslip.payslip', [
            'payslip' => $payslip,
            'period' => $period,
            'employee'  => $payslip->employee,
            'company'   => $payslip->company,
        ]);

        return $pdf->download('payslip-' . $payslip->employee->fullname . '-' . $period . '.pdf');
    }
}