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
        'wd_sunday',
        'wd_monday',
        'wd_tuesday',
        'wd_wednesday',
        'wd_thursday',
        'wd_friday',
        'wd_saturday',
    ];

    public $rules = [
        'company_id'  => 'required',
        'name'  => 'required',
        'default'  => 'required',
        'start_time'  => 'required',
        'end_time'  => 'required',
        'wd_sunday'    => 'nullable|boolean',
        'wd_monday'    => 'nullable|boolean',
        'wd_tuesday'   => 'nullable|boolean',
        'wd_wednesday' => 'nullable|boolean',
        'wd_thursday'  => 'nullable|boolean',
        'wd_friday'    => 'nullable|boolean',
        'wd_saturday'  => 'nullable|boolean',
    ];

    public $casts = [
        'default'   => 'boolean',
        'wd_sunday' => 'boolean',
        'wd_monday' => 'boolean',
        'wd_tuesday' => 'boolean',
        'wd_wednesday' => 'boolean',
        'wd_thursday' => 'boolean',
        'wd_friday' => 'boolean',
        'wd_saturday' => 'boolean',
        'start_time'   => 'datetime:H:i:s',
        'end_time'     => 'datetime:H:i:s',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model){
            if ($model->default == null) $model->default = false;

            // Default all working day fields to false if not explicitly set
            foreach (['wd_sunday','wd_monday','wd_tuesday','wd_wednesday','wd_thursday','wd_friday','wd_saturday'] as $day) {
                if ($model->$day === null) {
                    $model->$day = false;
                }
            }
        });
    }

    // data array to show button dummy data
    public static function dummy_data($company_id = null) : array
    {
        $company_id = $company_id ?? auth()->user()->company_id ?? null;

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
