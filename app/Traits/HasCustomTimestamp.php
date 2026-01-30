<?php

namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;

trait HasCustomTimestamp 
{

    public static function bootHasCustomTimestamp()
    {
        static::creating(function($model){
            $model->timestamps = false;
            $model->created_at = Carbon::now()->toIso8601String();
        });

        static::updating(function($model){
            $model->timestamps = false;
            $model->updated_at = Carbon::now()->toIso8601String();
        });
    }
}