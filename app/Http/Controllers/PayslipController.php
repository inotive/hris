<?php

namespace App\Http\Controllers;

use App\Helpers\PayslipHelper;

class PayslipController extends Controller
{
    public function download($id)
    {
        return (new PayslipHelper())->download($id);
    }

    public function view($id)
    {
        return (new PayslipHelper())->view($id);
    }

    public function print($id)
    {
        return view('employee_payslips.print', compact('id'));
    }
}
