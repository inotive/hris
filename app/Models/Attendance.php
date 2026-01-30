<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\HasCustomTimestamp;
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
    use HasCustomTimestamp;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string




    public $fillable = [
        'employee_id',
        'date',
        'clockin_time',
        'clockin_image',
        'clockin_lat',
        'clockin_long',
        'clockout_time',
        'clockout_image',
        'clockout_lat',
        'clockout_long',
        'clockin_status',
        'clockin_range_status',
        'clockout_range_status',
        'total_working_hours',
    ];

    public $rules = [
        'employee_id'  => 'required',
        'date'  => 'required',
        'clockin_time'  => 'required',
        'clockin_image'  => '',
        'clockin_lat'  => 'required',
        'clockin_long'  => 'required',
        'clockout_time'  => 'required',
        'clockout_image'  => '',
        'clockout_lat'  => 'required',
        'clockout_long'  => 'required',
        'clockin_status'  => '',
        'clockin_range_status'  => '',
        'clockout_range_status'  => '',
        'total_working_hours'  => '',
    ];

    public $casts = [
        'clockin_lat'   => 'float',
        'clockin_long'   => 'float',
        'clockout_lat'   => 'float',
        'clockout_long'   => 'float',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($row){
            $employee = Employee::find($row->employee_id);

            if ($row->employee_id != null)  {

                $row->employee_shift_id = $employee->employee_shift_id;
                $row->company_id = $employee->company_id;
            }
        });

        static::saving(function($row){
            $employee = Employee::find($row->employee_id);


            if ($row->clockin_time != null) {
                $date = $row->date;
                $carbonDateTime =  Carbon::parse($row->clockin_time);


                $shift = EmployeeShift::find($employee->employee_shift_id);

                if ($shift != null) {
                    $start = Carbon::parse($shift->start_time);
                    if ($carbonDateTime->greaterThan($start)) {
                        $row->clockin_status = 'LATE';
                    } else {
                        $row->clockin_status = 'EARLY';
                    }

                    Log::info($row->clockin_status);
                }


            }

            if ($row->clockout_time != null) {
                $date = $row->date;
                $carbonDateTime = Carbon::parse($row->clockout_time);

                $shift = EmployeeShift::find($employee->employee_shift_id);

                if ($shift != null) {
                    $end_time = Carbon::parse($shift->end_time);
                    if ($carbonDateTime->greaterThan($end_time)) {
                        $row->clockout_status = 'LATE';
                    } else {
                        $row->clockout_status = 'EARLY';
                    }

                    Log::info($row->clockin_status);
                }
            }

            if ($row->clockin_time && $row->clockout_time) {
                $clockInTime = Carbon::parse($row->clockin_time);
                $clockOutTime = Carbon::parse($row->clockout_time);
                $row->total_working_hours = $clockInTime->diffInHours($clockOutTime);
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


    public  static function monthDropdown()
    {
        $months = [
            ['key' => '1', 'value' => __('January')],
            ['key' => '2', 'value' => __('February')],
            ['key' => '3', 'value' => __('March')],
            ['key' => '4', 'value' => __('April')],
            ['key' => '5', 'value' => __('May')],
            ['key' => '6', 'value' => __('June')],
            ['key' => '7', 'value' => __('July')],
            ['key' => '8', 'value' => __('August')],
            ['key' => '9', 'value' => __('September')],
            ['key' => '10', 'value' => __('October')],
            ['key' => '11', 'value' => __('November')],
            ['key' => '12', 'value' => __('December')],
        ];

        return $months;
    }

    public  static function yearDropdown()
    {
        $years = [];
        for($i = date('Y') - 1; $i <= date('Y') + 5; $i++) {
            $years[] = [
                'key'   => $i,
                'value' => $i,
            ];
        }

        return $years;
    }


    public function getClockinTimeAttribute()
    {
        if (!isset($this->attributes['clockin_time']) || $this->attributes['clockin_time'] == null) return null;
        return Carbon::parse($this->attributes['clockin_time']);
    }

    public function getClockoutTimeAttribute()
    {
        if (!isset($this->attributes['clockout_time']) || $this->attributes['clockout_time'] == null) return null;
        return Carbon::parse($this->attributes['clockout_time']);
    }
}
