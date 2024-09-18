<?php

namespace App\Http\Controllers;

use App\Models\EmployeePosition;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeePositionController extends Controller
{
    use CrudTrait;

    public $model = EmployeePosition::class;
    public $route = 'employee-positions'; 
    public $page_title = 'Employee Position';
}
