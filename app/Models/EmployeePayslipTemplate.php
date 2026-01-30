<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslipTemplate extends Model
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
        'employee_payslip_master_id',
        'payslip_type',
        'type',
        'value',
        'created_by_user_id',
    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_id'  => 'required',
        'employee_payslip_master_id'  => 'required',
        'payslip_type'  => 'required',
        'type'  => 'required',
        'value'  => 'required',
        'created_by_user_id'  => 'required',
    ];


    public function master()
    {
        return $this->belongsTo(EmployeePayslipMaster::class, 'employee_payslip_master_id', 'id');
    }


    public static function initData($employee_id)
    {
        $masters = EmployeePayslipMaster::whereNotNull('slug')->get();

        $employee = Employee::find($employee_id);
        foreach($masters as $key => $value) {
            EmployeePayslipTemplate::firstOrCreate([
                'company_id'    => $employee->company_id,
                'employee_id'   => $employee_id,
                'employee_payslip_master_id'    => $value->id,
                'payslip_type'  => $value->master_type,
                'type'  => 'main',
            ]);
        }
    }
}
