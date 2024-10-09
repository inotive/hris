<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslipDetail extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'employee_payslip_master_id',
        'payslip_type',
        'value',
        'employee_payslip_id',
    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_payslip_master_id'  => 'required',
        'payslip_type'  => 'required',
        'value'  => 'required',
        'employee_payslip_id'  => 'required',
    ];


    public function master()
    {
        return $this->belongsTo(EmployeePayslipDetail::class, 'employee_payslip_master_id', 'id');
    }
}
