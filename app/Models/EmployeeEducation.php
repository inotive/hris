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

    public $rules = [
        'employee_id' => 'required',
        'education_level' => 'required',
        'institution' => 'required',
        'faculty' => 'required',
        'major' => 'required',
        'start_year' => 'required',
        'end_year' => 'required',
        'gpa' => 'required',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'default' => 'required',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public static function educationLevelDropdown()
    {
        return [
            'SD'  => 'SD',
            'SMP'  => 'SMP',
            'SMA'  => 'SMA',
            'SMK'  => 'SMK',
            'D3'  => 'D3',
            'S1'  => 'S1',
            'S2'  => 'S2',
            'S3'  => 'S3',
            'Lainnya'  => 'Lainnya',
        ];
    }
}
