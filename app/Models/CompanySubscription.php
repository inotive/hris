<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\PayoutSettingJob;

class CompanySubscription extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    protected $table = 'company_subscriptions';

    public $fillable = [
        'company_id',
        'start_date_at',
        'end_date_at',
        'subscription_type',
        'subscription_description',
        'price',
        'payment_bank_account_no',
        'payment_bank_account_name',
        'payment_bank_account_logo',
        'payment_at',
        'payment_status',
        'bank',
    ];

    public function rules($id = null)
    {
        return [
            'company_id'  => 'required',
            'start_date_at'  => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($id) {
                    $query = self::where('company_id', request('company_id'))
                        ->where(function($q) use ($value) {
                            $q->where('start_date_at', '<=', $value)
                              ->where('end_date_at', '>=', $value);
                        });
                    
                    if ($id) {
                        $query->where('id', '!=', $id);
                    }
                    
                    if ($query->exists()) {
                        $fail('The selected date range conflicts with an existing subscription for this company.');
                    }
                },
            ],
            'end_date_at'  => [
                'required',
                'date',
                'after:start_date_at',
                function ($attribute, $value, $fail) use ($id) {
                    $query = self::where('company_id', request('company_id'))
                        ->where(function($q) use ($value) {
                            $q->where('start_date_at', '<=', $value)
                              ->where('end_date_at', '>=', $value);
                        });
                    
                    if ($id) {
                        $query->where('id', '!=', $id);
                    }
                    
                    if ($query->exists()) {
                        $fail('The selected date range conflicts with an existing subscription for this company.');
                    }
                },
            ],
            'subscription_type'  => 'required',
            'subscription_description'  => 'required',
            'price'  => 'required|numeric|min:0',
            'payment_bank_account_no'  => 'required',
            'payment_bank_account_name'  => 'required',
            'payment_bank_account_logo'  => 'nullable',
            'payment_at'  => 'nullable|date',
            'payment_status'  => 'boolean',
            'bank'  => 'required',
        ];
    }

    public $casts = [
        'payment_status'  => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->refresh();
            if ($model->id != null) {
                for ($i = date('Y'); $i < date('Y') + 5; $i++) {
                    PayoutSettingJob::dispatch($model->company_id, $i, auth()->user()->id ?? null);
                }
            }
        });
    }
}
