<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContract extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string



    public $fillable = [
        'employee_id',
        'status',
        'date_start',

        'date_end',
        'notes',
        'file',
    ];


    public $rules = [
        'employee_id' => 'required',
        'status' => 'required',
        'date_start' => 'required',
        'date_end' => 'required',
        'notes' => 'required',
        'file' => 'required',
    ];




    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public static function statusDropdown()
    {
        return [
            'internship'=> 'Internship', 
            'probation'=> 'Probation', 
            'contract'=> 'Contract', 
            'permanent'=>'Permanent',
            'resignation'   => 'Resignation',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::statusDropdown()[$this->status] ?? '-';
    }
}
