<?php

namespace App\Traits;


trait SearchTrait 
{

    public function scopeSearch($query, $search)
    {
      
        return $query->where(function($query) use ($search){
            $search_field = $this->fillable ?? [];

            foreach($search_field as $key => $value) {
                if ($key == 0) {
                    $query = $query->where($value, 'like', '%'.$search.'%');
                } else {
                    $query = $query->orWhere($value, 'like', '%'.$search.'%');
                }
            } 

            return $query;
        });
    }

    public function scopeFilter($query, $filters)
    {
      
        return $query->where(function($query) use ($filters){
            
            foreach($filters ?? [] as $key => $value) {
                if ($value != null && strlen($value) > 0) {
                    if ($key == 0) {
                        $query = $query->where($key, $value);
                    } else {
                        $query = $query->where($key, $value);
                    }
                }
              
            }

            return $query;
        });
    }
}