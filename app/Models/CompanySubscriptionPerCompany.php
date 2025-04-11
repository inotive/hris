<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubscriptionPerCompany extends CompanySubscription
{
    

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('filter_by_request_company_id', function ($query) {
            if (request()->has('company_id')) {
                $query->where('company_id', request()->get('company_id'));
            } else {
                $query->where('company_id', auth()->user()->company_id);
            }
        });
    }
}
