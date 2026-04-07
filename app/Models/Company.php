<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function active_subscriptions()
    {
        return $this->subscriptions()->orderBy('created_at', 'desc');
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

    public function getMonthPeriod($year, $month)
    {
        $date = Carbon::createFromDate($year, $month, 1);
        
        $start_date = $date->copy()->startOfMonth();
        $end_date = $date->copy()->endOfMonth();

        if ($this->cut_off_payroll_date != null && $this->cut_off_payroll_date > 0 && $this->cut_off_payroll_date <= 31) {
            $cutoff_date = $this->cut_off_payroll_date;
            
            // Adjust for end of month issues (e.g. Feb 30)
            // If cutoff is 31 and month only has 30 days, Carbon handles it, but let's be safe: uses min(cutoff, daysInMonth)
            
            if ($this->cut_off_payroll_method == 'current') {
                // Period ends on cutoff of current month
                // Starts on cutoff+1 of previous month
                $daysInMonth = $date->daysInMonth;
                $effectiveCutoff = min($cutoff_date, $daysInMonth);
                $end_date = Carbon::createFromDate($year, $month, $effectiveCutoff);
                
                $start_date = $end_date->copy()->subMonth()->addDay();
            } elseif ($this->cut_off_payroll_method == 'previous') {
                 // For 'previous', we shift back one month
                $date = $date->subMonth();
                $year = $date->year;
                $month = $date->month;
                
                $daysInMonth = $date->daysInMonth;
                $effectiveCutoff = min($cutoff_date, $daysInMonth);
                $end_date = Carbon::createFromDate($year, $month, $effectiveCutoff);
                
                $start_date = $end_date->copy()->subMonth()->addDay();
            }
        }

        return [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')];
    }

    public function rules()
    {
        $companyId = $this->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $companyId,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'sub_district' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'time_zone' => 'required|string|max:50',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'logo' => 'nullable|string',
            'cut_off_payroll_date' => 'required|integer|min:1|max:31',
            'cut_off_payroll_method' => 'required|in:current,previous',
            'tax_calculation_method' => 'required|in:gross,nett',
            'status' => 'required|boolean',
            'is_overtime_request' => 'nullable|boolean',
            'is_leave_request' => 'nullable|boolean',
            'is_reimbursement_request' => 'nullable|boolean',
            'is_attendance' => 'nullable|boolean',
            'is_ewa' => 'nullable|boolean',
            'is_payslip' => 'nullable|boolean',
        ];
    }

    public static function tableQuery()
    {
        $query = static::query();
        $user = auth()->user();
        
        if ($user && $user->role !== 'superadmin') {
            $query->where('id', $user->company_id);
        }

        return $query->search(request('search'))
            ->filter(request('filter'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
