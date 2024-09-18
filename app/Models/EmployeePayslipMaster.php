<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
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


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'name',
        'description',
        'master_type',
        'type',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'description'  => 'required',
        'master_type'  => 'required',
        'type'  => 'required',
    ];


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


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
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
