<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use CrudTrait;

    public $model = Employee::class;
    public $route = 'employees'; 
}
