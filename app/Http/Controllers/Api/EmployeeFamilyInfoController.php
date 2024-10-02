<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeFamilyInfo;
use App\Traits\CrudApiTrait;
use Illuminate\Http\Request;

class EmployeeFamilyInfoController extends Controller
{
    use CrudApiTrait;

    public $model = EmployeeFamilyInfo::class;

}
