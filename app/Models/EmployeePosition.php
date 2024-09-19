<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'department_id',
        'name',
        'description',
        'prefix',
    ];

    public $rules = [
        'company_id'  => 'required',
        'department_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
    ];


    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class,'department_id','id');
    }


    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'HR Manager',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'HR Specialist',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Recruiter',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Training & Development Officer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Payroll Officer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'CFO (Chief Financial Officer)',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Finance Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Accounting Supervisor',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Financial Analyst',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Tax Officer',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'CMO (Chief Marketing Officer)',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Marketing Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Digital Marketing Specialist',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Content Creator',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Market Research Analyst',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Sales Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Sales Executive',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Sales Representative',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Key Account Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Production Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Quality Control Manager',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Production Supervisor',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'prefix'    => '',
            'department_id'    => '',
            'name'  =>  'Machine Operator',
            'description'  =>  '',
        ];

        foreach($data as $key => $value) {
            $prefix = $value['prefix'] != null && strlen($value['prefix']) > 0 ? $value['prefix'] : 'other1';
            $value['prefix'] = $prefix;
            $value['department_id'] = EmployeeDepartment::where('company_id', $company_id)->where('prefix', $prefix)->first()->id ?? null;
            $data[$key] = $value;
        }


        return $data;
    }
}
