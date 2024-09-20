<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'employee_id',
        'employee_shift_id',
        'date',
        'clockin_time',
        'clockin_image',
        'clockin_lat',
        'clockin_long',
        'clockout_time',
        'clockout_image',
        'clockout_lat',
        'clockout_long',
        'clockin_present_status',
        'clockin_range_status',
        'clockout_range_status',
    ];

    public $rules = [
        'employee_id'  => '',
        'employee_shift_id'  => '',
        'date'  => '',
        'clockin_time'  => '',
        'clockin_image'  => '',
        'clockin_lat'  => '',
        'clockin_long'  => '',
        'clockout_time'  => '',
        'clockout_image'  => '',
        'clockout_lat'  => '',
        'clockout_long'  => '',
        'clockin_present_status'  => '',
        'clockin_range_status'  => '',
        'clockout_range_status'  => '',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

}
