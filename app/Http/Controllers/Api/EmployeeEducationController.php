<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeEducation;
use App\Models\EmployeeEmergencyContact;
use App\Models\EmployeeFamilyInfo;
use App\Traits\CrudApiTrait;
use Illuminate\Http\Request;

class EmployeeEducationController extends Controller
{
    use CrudApiTrait;

    public $model = EmployeeEducation::class;

    public $base64_files = [

    ];

    public function educationLevel()
    {
        $list = EmployeeEducation::educationLevelDropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }
}
