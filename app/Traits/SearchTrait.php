<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

trait SearchTrait 
{

    public function scopeSearch($query, $search)
    {
        $columns =  Schema::getColumnListing((new self)->getTable());
      
        $query = $query->where(function($query) use ($search, $columns){
            $search_field = $this->search_columns ?? $this->fillable ?? [];

            $k = 0;
            foreach($search_field as $key => $value) {
                try{
                    $is_boolean = $this->casts[$value] == 'boolean' ?? false;
                }catch(Exception $e){
                    $is_boolean = false;
                }


         

                if ($is_boolean) {
                    $value_boolean = strtolower($search) == 'yes';

                    
   

                    if (in_array(strtolower($search), ["yes", "no"])) {
                        if ($k == 0) {
                            $query = $query->where($value, $value_boolean);
                        } else {
                            $query = $query->orWhere($value, $value_boolean);
                        }
                    }

                } else {
                    if ($k == 0) {
                        $query = $query->where($value, 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($value, 'like', '%'.$search.'%');
                    }
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

                try{
                    if ($k == 0) {
                        $query = $query->whereHas('employee',$fnc);
                    } else {
                        $query = $query->orWhereHas('employee', $fnc);
                    }
                }catch(Exception $e){
                    
                }
            }


            if (in_array('company_id', $columns)) {
                $fnc = function($query) use($search){
                    $query->where('name','like','%'.$search.'%');
                };

                try{
                    if ($k == 0) {
                        $query = $query->whereHas('company',$fnc);
                    } else {
                        $query = $query->orWhereHas('company', $fnc);
                    }
                }catch(Exception $e){
                    
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
                 
                        try{
                            $is_boolean = $this->casts[$key] == 'boolean' ?? false;
                        }catch(Exception $e){
                            $is_boolean = false;
                        }

                     

                        if ($is_boolean) {
                            $value_boolean = strtolower($value) == 'yes';

                   
                            if (in_array(strtolower($value), ["yes", "no"])) {
                                if ($key == 0) {
                                    $query = $query->where($key, $value_boolean);
                                } else {
                                    $query = $query->orWhere($key, $value_boolean);
                                }
                            }
        
                        }else{
                            if ($key == 0) {
                                $query = $query->where($key, $value);
                            } else {
                                $query = $query->where($key, $value);
                            }
                        }
            
                    } else {

                        // query khusus
                        if ($key == 'company_id' && in_array('employee_id', $columns)) {
                            $query->whereHas('employee', function($query) use($value){
                                $query->where('company_id', $value);
                            });
                        } else if ($key == 'payment_status') {
                            $query->whereHas('subscriptions', function($query) use($value){
                                $query->where('payment_status', $value == 'YES')
                                    ->where('start_date_at', '<=', Carbon::now()->format('Y-m-d'))
                                    ->where('end_date_at', '>=', Carbon::now()->format('Y-m-d'));
                            });
                        }
                    }
                }
              
            }

            return $query;
        });
    }
}