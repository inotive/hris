<?php

namespace App\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

trait HasMyCompany 
{


    public static function bootHasMyCompany()
    {

        static::addGlobalScope('filter_by_my_company', function (Builder $builder) {
            if (auth()->user()->company_id != null) {
                $builder->where('id', auth()->user()->company_id);
            }
       
        });
    }


}