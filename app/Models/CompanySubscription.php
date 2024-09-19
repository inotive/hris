<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubscription extends Model
{
    use HasFactory;
    use HasUuids;

    use SearchTrait;
    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


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
    ];

    public $rules = [
        'company_id'  => 'required',
        'start_date_at'  => 'required',
        'end_date_at'  => 'required',
        'subscription_type'  => 'required',
        'subscription_description'  => 'required',
        'price'  => 'required',
        'payment_bank_account_no'  => 'required',
        'payment_bank_account_name'  => 'required',
        'payment_bank_account_logo'  => 'required',
        'payment_at'  => '',
        'payment_status'  => '',
    ];
}
