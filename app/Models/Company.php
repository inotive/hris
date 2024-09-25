<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchTrait;
use App\Traits\CreatedByUserTrait;
use Illuminate\Validation\Rule;

class Company extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'cut_off_payroll_date',
        'is_overtime_request',
        'status',
        'country',
        'province',
        'city',
        'district',
        'sub_district',
        'zip_code',
        'time_zone',
    ];

    public $rules = [
        'name'  => 'required',
        'address'  => 'required',
        'phone'  => 'required',
        'email'  => [
            'required',
            'email',
        ],

        'logo'  => '',
        'cut_off_payroll_date'  => 'required',
        'is_overtime_request'  => '',
        'status'  => '',
        'time_zone'  => '',
        'country'  => '',
        'province'  => '',
        'city'  => '',
        'district'  => '',
        'sub_district'  => '',
        'zip_code'  => '',
    ];

    public $casts = [
        'is_overtime_request'   => 'boolean',
        'status'   => 'boolean',
        'cut_off_payroll_date'   => 'integer',
    ];
}
