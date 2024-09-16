<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEmergencyContact;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class EmployeeEmergencyContactController extends Controller
{
    use CrudTrait;

    public $model = EmployeeEmergencyContact::class;
    public $route = 'employee-emergency-contacts'; 
    public $page_title = 'Employee Emergency Contact';
}
