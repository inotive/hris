<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOrganizationExperience extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string



    public $fillable = [
        'employee_id',
        'company_name',
        'company_location',
        'line_of_business',
        'position_held',
        'job_description',
        'achievement',
        'start_period',
        'end_period',
        'initial_currency',
        'initial_sallary',
        'initial_period',
        'last_currency',
        'last_sallary',
        'last_period',
        'reason_leaving',
        'reference_name',
        'reference_phone',
        'reference_position',
    ];


    public $rules = [
        'employee_id' => 'required',
        'company_name' => 'required',
        'company_location' => 'required',
        'line_of_business' => 'required',
        'position_held' => 'required',
        'job_description' => 'required',
        'start_period' => 'required',
        'end_period' => 'required',
        'initial_currency' => 'required',
        'initial_sallary' => 'required',
        'initial_period' => 'required',
        'last_currency' => 'required',
        'last_sallary' => 'required',
        'last_period' => 'required',
        'reason_leaving' => 'required',
    ];


    public $casts = [
        'start_period'=> 'date:Y-m-d',
        'end_period'=> 'date:Y-m-d',
    ];
    

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }


}
