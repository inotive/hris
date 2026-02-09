<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    use HasFactory, SoftDeletes, SearchTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'province',
        'city',
        'district', // Text
        'sub_district', // Text
        'zip_code',
        'time_zone',
        'lat',
        'lng',
        'logo',
        'created_by_user_id',
        'cut_off_payroll_date',
        'cut_off_payroll_method',
        'tax_calculation_method',
        'status',
        'is_overtime_request',
        'is_leave_request',
        'is_reimbursement_request',
        'is_attendance',
        'is_ewa',
        'is_payslip',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Uuid::uuid4()->toString();
            }
        });

        static::deleting(function ($company) {
            $company->subscriptions()->each(function ($subscription) {
                $subscription->delete();
            });
        });
    }

    // Relationships to Location
    // public function country()
    // {
    //     return $this->belongsTo(Country::class);
    // }

    // public function province()
    // {
    //     return $this->belongsTo(Province::class);
    // }

    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }

    // Accessors for backward compatibility
    public function getCountryNameAttribute()
    {
        return $this->country ?? '';
    }

    public function getProvinceNameAttribute()
    {
        return $this->province ?? '';
    }

    public function getCityNameAttribute()
    {
        return $this->city ?? '';
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function departments()
    {
        return $this->hasMany(EmployeeDepartment::class);
    }

    public function positions()
    {
        return $this->hasMany(EmployeePosition::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function active_contracts()
    {
        return $this->hasManyThrough(EmployeeContract::class, Employee::class);
    }

    public function getTotalEmployeeAttribute()
    {
        return $this->employees()->count();
    }

    public function getTotalDepartmentAttribute()
    {
        return $this->departments()->count();
    }

    public function subscriptions()
    {
        return $this->hasMany(CompanySubscription::class);
    }
}
