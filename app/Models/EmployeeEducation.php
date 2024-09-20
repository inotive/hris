<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string



    public $fillable = [
        'employee_id',
        'institution',
        'education_level',
        'faculty',
        'major',
        'start_year',
        'end_year',
        'gpa',
        'gpa_scale',
        'country',
        'state',
        'city',
        'default',
        'certificate_no',
        'certificate_date',
        'certificate_file',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
