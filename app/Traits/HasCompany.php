<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;

trait HasCompany 
{


    public static function boot()
    {
        parent::boot();

         // Adding a global scope to apply a 'where' condition to all queries
         static::addGlobalScope('filter_by_company', function (Builder $builder) {
            if (auth()->user()->role == 'admin') {
                // $builder->where('company_id', 'active');
            }
       
        });
    }
}