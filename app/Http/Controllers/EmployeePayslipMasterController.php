<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipMaster;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeePayslipMasterController extends Controller
{
    use CrudTrait;

    public $model = EmployeePayslipMaster::class;
    public $route = 'employee-payslip-masters'; 
    public $page_title = 'Employee Payslip Master';

    
}
