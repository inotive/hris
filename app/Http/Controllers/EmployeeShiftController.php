<?php

namespace App\Http\Controllers;

use App\Models\EmployeeShift;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeShiftController extends Controller
{
    use CrudTrait;

    public $model = EmployeeShift::class;
    public $route = 'employee-shifts'; 
    public $page_title = 'Employee Shift';
}
