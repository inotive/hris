<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
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
        'leave_type_id',
        'start_date',
        'end_date',
        'total_days',
        'status',
        'reason',

    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_id'  => 'required',
        'manager_id'  => '',
        'leave_type_id'  => 'required|exists:leave_types,id',
        'start_date'    => 'required|date|before:end_date',
        'end_date'      => 'required|date|after:start_date',
        'total_days'  => '',
        'status'  => '',
        'reason'  => 'required',

    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function($row){

            $employee = Employee::find($row->employee_id);
            $row->manager_id = $employee->head_department->id ?? $employee->department->head_departmen_id ?? null;


            $row->status = 'pending';


            if ($row->start_date && $row->end_date) {
                $start_date = Carbon::parse($row->start_date);
                $end_date = Carbon::parse($row->end_date);
                $row->total_days = $start_date->diffInDays($end_date);
            }
        });


        static::created(function($row){


            Request::create([
                'company_id'    => $row->company_id,
                'employee_id'    => $row->employee_id,
                'manager_id'    => $row->manager_id,
                'title'    => 'Leave Request',
                'content'    => 'Leave Request. Need Approve',
                'reference'    => $row->id,
                'type'  => 'pending',
                'module'  => 'leave',
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


    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class,'manager_id','id');
    }


    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class,'leave_type_id','id');
    }

    public function files()
    {
        return $this->hasMany(File::class,'module_id','id');
    }


    public static function reasonLeavingDropdown()
    {
        return [
            'Kematian'  => 'Kematian',
            'Berhenti'  => 'Berhenti',
            'Pensiun'  => 'Pensiun',
            'Relokasi'  => 'Relokasi',
            'Berakhir'  => 'Berakhir',
        ];
    }
}
