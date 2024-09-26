<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslip extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'employee_id',
        'total_payslip_earning',
        'total_payslip_deduction',
        'sub_total_payslip',
        'tax',
        'take_home_pay',
        'pay_date',
        'metode',
        'account_number',
        'account_name',
        'file',
    ];

    public $rules = [
        'company_id'  => 'required',
        'employee_id'  => 'required',
        'total_payslip_earning'  => '',
        'total_payslip_deduction'  => '',
        'sub_total_payslip'  => '',
        'tax'  => '',
        'take_home_pay'  => '',
        'pay_date'  => '',
        'metode'  => '',
        'account_number'  => '',
        'account_name'  => '',
        'file'  => '',
    ];

    public $casts = [
        'total_payslip_earning' => 'integer',
        'total_payslip_deduction' => 'integer',
        'sub_total_payslip' => 'integer',
        'tax' => 'integer',
        'take_home_pay' => 'integer',
    ];
}
