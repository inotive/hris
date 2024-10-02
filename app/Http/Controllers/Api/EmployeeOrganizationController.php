<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeContract;
use App\Models\EmployeeEducation;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeFamilyInfo;
use App\Models\EmployeeOrganizationExperience;
use App\Traits\CrudApiTrait;
use Illuminate\Http\Request;

class EmployeeOrganizationController extends Controller
{
    use CrudApiTrait;

    public $model = EmployeeOrganizationExperience ::class;

    public $base64_files = [

    ];
}
