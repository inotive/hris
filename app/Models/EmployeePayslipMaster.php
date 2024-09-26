<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslipMaster extends Model
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
        'name',
        'description',
        'master_type',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
        'master_type'  => 'required',
    ];

    public function scopeMasterTypeEarning($query)
    {
        return $query->where('master_type', 'earning');
    }

    public function scopeMasterTypeDeduction($query)
    {
        return $query->where('master_type', 'deduction');
    }

    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'earning',
            'name'  =>  'Basic Sallary',
            'description'  =>  '',
        ];

        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'earning',
            'name'  =>  'Tax Allowance',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'earning',
            'name'  =>  'Tunjangan Jabatan',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'deduction',
            'name'  =>  'BPJS Kesehatan',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'deduction',
            'name'  =>  'JHT Employee',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'deduction',
            'name'  =>  'PPH 21',
            'description'  =>  '',
        ];
        $data[] = [
            'company_id'    => $company_id,
            'master_type'  =>  'deduction',
            'name'  =>  'Notebook Loan',
            'description'  =>  '',
        ];

  
        return $data;
    }


    public static function master_type_dropdown()
    {
        return [
            'earning'   => __('Earnings'),
            'deduction'   => __('Deductions'),
        ];
    }


    public static function type_dropdown()
    {
        return [
            'main'   => __('Main'),
            'additional'   => __('Additional'),
        ];
    }

    public function getMasterTypeNameAttribute()
    {
        return self::master_type_dropdown()[$this->master_type] ?? '-';
    }

    public function getTypeNameAttribute()
    {
        return self::type_dropdown()[$this->type] ?? '-';
    }

    
}
