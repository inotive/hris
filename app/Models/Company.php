<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchTrait;
use App\Traits\CreatedByUserTrait;
use App\Traits\HasMyCompany;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Company extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;
    use HasMyCompany;


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
        'cut_off_payroll_method',
        'is_overtime_request',
        'is_leave_request',
        'is_reimbursement_request',
        'is_attendance',
        'is_ewa',
        'is_payslip',
        'status',
        'country',
        'province',
        'city',
        'district',
        'sub_district',
        'zip_code',
        'time_zone',
        'tax_calculation_method',
        'lat',
        'lng',
    ];

    public $rules = [
        'name' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'email' => [
            'required',
            'email',
        ],

        'logo' => '',
        'cut_off_payroll_date' => 'required',
        'cut_off_payroll_method' => 'required',
        'is_overtime_request' => '',
        'is_leave_request' => '',
        'is_reimbursement_request' => '',
        'is_attendance' => '',
        'is_ewa' => '',
        'is_payslip' => '',
        'status' => '',
        'time_zone' => '',
        'country' => '',
        'province' => '',
        'city' => '',
        'district' => '',
        'sub_district' => '',
        'zip_code' => '',
        'tax_calculation_method' => '',
        'lat' => '',
        'lng' => '',
    ];

    public $casts = [
        'is_overtime_request' => 'boolean',
        'status' => 'boolean',
        'cut_off_payroll_date' => 'integer',
        'is_leave_request' => 'boolean',
        'is_reimbursement_request' => 'boolean',
        'is_attendance' => 'boolean',
        'is_ewa' => 'boolean',
        'is_payslip' => 'boolean',
    ];

    // public function scopeWithinRadiusInMeters($query, $latitude, $longitude, $radius = 1000)
    // {
    //     return $query->selectRaw("
    //             *,
    //             (6371000 * acos(
    //                 cos(radians(?)) *
    //                 cos(radians(latitude)) *
    //                 cos(radians(longitude) - radians(?)) +
    //                 sin(radians(?)) *
    //                 sin(radians(latitude))
    //             )) AS distance
    //         ", [$latitude, $longitude, $latitude])
    //         ->having('distance', '<=', $radius)
    //         ->orderBy('distance', 'asc');
    // }


    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->tax_calculation_method != null && $model->tax_calculation_method == 'none') {
                $model->tax_calculation_method = null;
            }
        });
    }


    public function getMonthPeriod($year, $month)
    {
        $cut_off_payroll_method = $this->cut_off_payroll_method;

        $month_period_start = Carbon::parse($year . "-" . $month . "-01")->format('Y-m-01');
        $month_period_end = Carbon::parse($year . "-" . $month . "-01")->format('Y-m-t');

        if ($cut_off_payroll_method == 'backward') {
            // mundur sebulan
            $month = Carbon::parse($year . "-" . $month . "-01");
            $prev_month = $month->subMonth();
            // cari tanggal awal
            $start_cutoff = CompanyPayoutSetting::where('company_id', $this->company_id)
                ->whereYear('date', $prev_month->format('Y'))
                ->whereMonth('date', $prev_month->format('m'))
                ->first();

            $end_cutoff = CompanyPayoutSetting::where('company_id', $this->company_id)
                ->whereYear('date', $month->format('Y'))
                ->whereMonth('date', $month->format('m'))
                ->first();

            if ($start_cutoff != null && $end_cutoff != null) {
                $month_period_start = $start_cutoff->date;
                $month_period_end = $end_cutoff->date;
            }
        }


        return [$month_period_start, $month_period_end];
    }


    public function getDateTimeLocationAttribute()
    {
        return Carbon::now()->setTimezone($this->time_zone)->toIso8601String();
    }

    public function getTotalUserAttribute(): int
    {
        return User::where('company_id', $this->id)->count();
    }

    public function getTotalEmployeeAttribute(): int
    {
        return Employee::where('company_id', $this->id)->count();
    }

    public function getTotalDepartmentAttribute()
    {
        return EmployeeDepartment::where('company_id', $this->id)->count();
    }

    public function active_contracts()
    {
        return collect(DB::select('SELECT employee_contracts.id,
                                    employee_contracts.date_start,
                                    employee_contracts.date_end,
                                    employee_contracts.employee_id,
                                    employee_contracts.created_at,
                                    employee_contracts.`status`

                                     FROM `employee_contracts`
                                     JOIN employees ON employees.id = employee_contracts.employee_id
                                     where employees.company_id = "' . $this->id . '"
                                     and  date_start <= now() and date_end >= now()'));
    }

    public function subscriptions()
    {
        return $this->hasMany(CompanySubscription::class, 'company_id');
    }

    public function active_subscriptions()
    {
        return $this->subscriptions
            ->where('start_date_at', '<=', Carbon::now()->format('Y-m-d'))
            ->where('end_date_at', '>=', Carbon::now()->format('Y-m-d'));
    }

    public function day_left_subscription()
    {
        try {
            $active_subscription = $this->active_subscriptions()->first();
            if ($active_subscription) {
                return Carbon::now()->diffInDays($active_subscription->end_date_at);
            }
            return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function total_day_subscription()
    {
        $active_subscription = $this->active_subscriptions()->first();
        if ($active_subscription) {
            return Carbon::parse($active_subscription->start_date_at)->diffInDays($active_subscription->end_date_at);
        }
        return 0;
    }

    public function day_left_percent_subscription()
    {
        try {
            $active_subscription = $this->active_subscriptions()->first();
            if ($active_subscription) {
                if ($this->total_day_subscription() <= 0) {
                    return 0;
                }
                return round(($this->day_left_subscription() / $this->total_day_subscription()) * 100, 0);
            }
            return 0;
        } catch (Exception $e) {
            Log::info($e);
            return 0;
        }
    }


    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
}
