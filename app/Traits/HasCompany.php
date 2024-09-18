<?php

namespace App\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

trait HasCompany 
{


    public static function bootHasCompany()
    {

        static::addGlobalScope('filter_by_company', function (Builder $builder) {
            if (auth()->user()->role == 'admin') {
                $builder->where('company_id', auth()->user()->company_id);
            }
       
        });
    }


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}