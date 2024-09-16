<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLevel;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeLevelController extends Controller
{
    use CrudTrait;

    public $model = EmployeeLevel::class;
    public $route = 'employee-levels'; 
    public $page_title = 'Employee Level';
}
