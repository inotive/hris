<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public $casts = [
        'clockin_time' => 'datetime',
        'clockout_time' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($row){
            $employee = Employee::find($row->employee_id);

            if ($row->employee_id != null)  {

                $row->employee_shift_id = $employee->employee_shift_id;
            }




            if ($row->clockin_time != null) {
                $date = $row->date;
                $time = $row->clockin_time->format('h:i:s');
                $timezone = $employee->company->time_zone;
                $carbonDateTime = Carbon::parse( "$date $time", $timezone);
                $row->clockin_time = $carbonDateTime;
            }

            if ($row->clockout_time != null) {
                $date = $row->date;
                $time = $row->clockout_time->format('h:i:s');
                $timezone = $employee->company->time_zone;
                $carbonDateTime = Carbon::parse( "$date $time", $timezone);
                $row->clockout_time = $carbonDateTime;
            }
        });

        static::updating(function($row){
            $employee = Employee::find($row->employee_id);


            if ($row->clockin_time != null) {
                $date = $row->date;
                $time = $row->clockin_time->format('h:i:s');
                $timezone = $employee->company->time_zone;
                $carbonDateTime =  Carbon::parse( "$date $time", $timezone);
                $row->clockin_time = $carbonDateTime;
            }

            if ($row->clockout_time != null) {
                $date = $row->date;
                $time = $row->clockout_time->format('h:i:s');
                $timezone = $employee->company->time_zone;
                $carbonDateTime = Carbon::parse( "$date $time", $timezone);
                $row->clockout_time = $carbonDateTime;

                // Log::info($carbonDateTime);
                // Log::info($carbonDateTime->timezoneName);
            }


        });

    }


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function employee_shift()
    {
        return $this->belongsTo(EmployeeShift::class,'employee_shift_id','id');
    }

}