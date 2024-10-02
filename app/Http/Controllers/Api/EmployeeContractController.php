<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeContract;
use App\Models\EmployeeEducation;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeFamilyInfo;
use App\Traits\CrudApiTrait;
use Illuminate\Http\Request;

class EmployeeContractController extends Controller
{
    use CrudApiTrait;

    public $model = EmployeeContract::class;

    public $base64_files = [

    ];
}
