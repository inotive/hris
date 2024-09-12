<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDepartment;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeDepartmentController extends Controller
{
    use CrudTrait;

    public $model = EmployeeDepartment::class;
    public $route = 'employee-departments'; 
    public $page_title = 'Employee Department';
}
