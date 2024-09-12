<?php

namespace App\Traits;


trait SearchTrait 
{

    public function scopeSearch($query, $search)
    {
        $search_field = $this->fillable ?? [];

        foreach($search_field as $key => $value) {
            if ($key == 0) {
                $query = $query->where($value, 'like', '%'.$search.'%');
            } else {
                $query = $query->orWhere($value, 'like', '%'.$search.'%');
            }
        }
        return $query;
    }
}