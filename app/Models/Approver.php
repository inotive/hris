<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;
    use HasUuids;
    use HasCompany;

    use SearchTrait;

    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'request_type',
        'employee_id',
        'approver_level',
        'approver_employee_id',
    ];

    public $rules = [
        'company_id'=>'required',
        'request_type'=>'required',
        'employee_id'=>'',
        'approver_level'=>'required',
        'approver_employee_id'=>'required',
    ];


    public function getRequestTypeNameAttribute() : string
    {
        $request_type = $this->attributes['request_type'];

        if ($request_type == 'leave') {
            return 'Leave';
        } elseif ($request_type == 'overtime') {
            return 'Overtime';
        } else if ($request_type == 'reimburse') {
            return 'Reimbursement';
        }
        return $request_type;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }

    public function approver_employee()
    {
        return $this->belongsTo(Employee::class,'approver_employee_id','id');
    }
}
