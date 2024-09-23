<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRequest extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'employee_id',
        'manager_id',
        'overtime_shift_request_id',
        'start_shift_date_time',
        'end_shift_date_time',
        'status',
        'compensation',
        'work_note',

    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_id'  => 'required',
        'manager_id'  => '',
        'overtime_shift_request_id'  => '',
        'start_shift_date_time'  => '',
        'end_shift_date_time'  => '',
        'compensation'  => '',
        'work_note'  => '',

    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function($row){

            $employee = Employee::find($row->employee_id);
            $row->manager_id = $employee->head_department->id ?? $employee->department->head_departmen_id ?? null;


            $row->status = 'pending';
        });


        static::created(function($row){


            Announcement::create([
                'company_id'    => $row->company_id,
                'employee_id'    => $row->employee_id,
                'manager_id'    => $row->manager_id,
                'title'    => 'Overtime Request',
                'content'    => 'Overtime Request. Need Approve',
                'reference'    => $row->id,
                'type'  => 'pending',
                'module'  => 'overtime',
                'module_id'  => $row->id,
            ]);
        });
    }


    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id;

        return [

        ];

    }

    public function getHoursAttribute()
    {
        // Assuming you have two DateTime instances
        $start = Carbon::parse($this->start_shift_date_time);
        $end = Carbon::parse($this->end_shift_date_time);

        // Calculate the difference in hours
        $hoursDifference = $start->diffInHours($end);

        return $hoursDifference;
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class,'manager_id','id');
    }


    public function overtime_shift_request()
    {
        return $this->belongsTo(OvertimeShiftRequest::class,'overtime_shift_request_id','id');
    }
}
