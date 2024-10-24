<?php

namespace App\Http\Controllers;

use App\Models\EmployeePayslipGenerate;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class GeneratePayslipController extends Controller
{
    use CrudTrait;

    public $model = EmployeePayslipGenerate::class;
    public $route = 'generate'; 
    public $page_title = 'Generate Payslip';


}
