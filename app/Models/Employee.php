<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'employee_shift_id',
        'employee_id',
        'email',
        'password',
        'phone',
        'department_id',
        'employee_position_id',
        'employee_level_id',
        'hire_date',
        'sallary',
        'image',
        'reimbursement_limit',
        'birth_date'
    ];

    public $rules = [
        'company_id'  => 'required',
        'first_name'  => 'required',
        'last_name'  => 'required',
        'employee_shift_id'  => 'required',
        'email'  => 'required',
        'phone'  => 'required',
        'department_id'  => 'required',
        'employee_position_id'  => 'required',
        'employee_level_id'  => 'required',
        'hire_date'  => 'required',
        'sallary'  => 'required',
        'image'  => 'required',
        'reimbursement_limit'  => 'required',
        'birth_date'  => 'required',
    ];


    public function getFullNameAttribute()
    {
        return collect($this->first_name, $this->last_name)->join(' ');
    }


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function department()
    {
        return $this->belongsTo(EmployeeDepartment::class,'department_id','id');
    }


    public function position()
    {
        return $this->belongsTo(EmployeePosition::class,'employee_position_id','id');
    }

    public function level()
    {
        return $this->belongsTo(EmployeeLevel::class,'employee_level_id','id');
    }
}
