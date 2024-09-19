<?php

namespace App\Models;

use App\Traits\SearchTrait;
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

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
