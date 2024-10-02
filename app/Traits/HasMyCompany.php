<?php

namespace App\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

trait HasMyCompany 
{


    public static function bootHasMyCompany()
    {

        static::addGlobalScope('filter_by_my_company', function (Builder $builder) {
            $company_id = auth()->user()?->company_id ?? null;
            if ($company_id !== null) {
                $builder->where('id', $company_id);
            }
        });
    }


}