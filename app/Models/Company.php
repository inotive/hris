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
        'telphone',
        'email',
        'logo',
        'general_pay_date',
        'is_overtime_request',
        'status',
    ];

    public $rules = [
        'name'  => 'required',
        'address'  => 'required',
        'telphone'  => 'required',
        'email'  => [
            'required',
            'email',
        ],

        'logo'  => '',
        'general_pay_date'  => 'required',
        'is_overtime_request'  => 'required',
        'status'  => 'required',
    ];

    public $casts = [
        'is_overtime_request'   => 'boolean',
        'status'   => 'boolean',
        'general_pay_date'   => 'integer',
    ];
}
