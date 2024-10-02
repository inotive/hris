<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeEmergencyContact;
use App\Traits\CrudApiTrait;
use Illuminate\Http\Request;

class EmployeeEmergencyContactController extends Controller
{
    use CrudApiTrait;

    public $model = EmployeeEmergencyContact::class;

}
