<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
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
        'default',
        'start_time',
        'end_time',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'default'  => 'required',
        'start_time'  => 'required|date_format:H:i:s',
        'end_time'  => 'required|date_format:H:i:s',
    ];

    public $casts = [
        'default'   => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model){
            if ($model->default == null) $model->default = false;
        });
    }

    public static function dummy_data() : array
    {
        $company_id = auth()->user()->company_id ?? null;

        $data = [];
        $data[] = [
            'company_id'    => $company_id,
            'name'    => 'Regular shift',
            'start_time'    => '09:00:00',
            'end_time'    => '17:00:00',
            'default'  =>  1,
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'    => 'Morning shift',
            'start_time'    => '04:00:00',
            'end_time'    => '12:00:00',
            'default'  =>  0,
        ];

        $data[] = [
            'company_id'    => $company_id,
            'name'    => 'Night shift',
            'start_time'    => '20:00:00',
            'end_time'    => '04:00:00',
            'default'  =>  0,
        ];

        return $data;
    }
}
