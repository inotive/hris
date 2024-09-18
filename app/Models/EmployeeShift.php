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

}
