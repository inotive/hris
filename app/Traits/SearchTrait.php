<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

trait SearchTrait 
{

    public function scopeSearch($query, $search)
    {
        $columns = Schema::getColumnListing((new self)->getTable());
      
        $query = $query->where(function($query) use ($search, $columns){
            $search_field = $this->fillable ?? [];

            $k = 0;
            foreach($search_field as $key => $value) {
                if ($k == 0) {
                    $query = $query->where($value, 'like', '%'.$search.'%');
                } else {
                    $query = $query->orWhere($value, 'like', '%'.$search.'%');
                }

                $k++;
            } 


            if (in_array('employee_id', $columns)) {
                $fnc = function($query) use($search){
                    $query->where('first_name','like','%'.$search.'%')
                        ->orWhere('last_name','like','%'.$search.'%')
                        ->orWhereRaw('concat(first_name, " ", last_name) like "%'.$search.'%"')
                        ->orWhereHas('company', function($query) use($search){
                            $query->where('name','like','%'.$search.'%');
                        })
                        ;
                };
                if ($k == 0) {
                    $query = $query->whereHas('employee',$fnc);
                } else {
                    $query = $query->orWhereHas('employee', $fnc);
                }
            }


            return $query;
        });


        return $query;
    }

    public function scopeFilter($query, $filters)
    {
      
        return $query->where(function($query) use ($filters){
            
            $columns = Schema::getColumnListing((new self)->getTable());

            
            foreach($filters ?? [] as $key => $value) {
                if ($value != null && strlen($value) > 0) {
                    if (in_array($key, $columns)) {
            
                            if ($key == 0) {
                                $query = $query->where($key, $value);
                            } else {
                                $query = $query->where($key, $value);
                            }
            
                    } else {

                        // query khusus
                        if ($key == 'company_id' && in_array('employee_id', $columns)) {
                            $query->whereHas('employee', function($query) use($value){
                                $query->where('company_id', $value);
                            });
                        }
                    }
                }
              
            }

            return $query;
        });
    }
}