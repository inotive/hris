<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipDetail;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeePayslipDetailController extends Controller
{
    use CrudTrait;

    public $model = EmployeePayslipDetail::class;
    public $route = 'employee-payslip-details'; 
    public $page_title = 'Employee Payslip Detail';
}
