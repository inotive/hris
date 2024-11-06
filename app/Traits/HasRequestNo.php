<?php

namespace App\Traits;

use App\Models\User;

trait HasRequestNo 
{

    public static function bootHasRequestNo()
    {

        static::booted(function ($model) {
            $model->fillable = array_merge($model->fillable, ['request_no']);
        });

        static::creating(function($model){
            $prefix = (new static)->request_no_prefix . date('Ymd');
            $last = (new static)->where('request_no','like', $prefix . '%')->orderBy('request_no','desc')->first()->request_no ?? null;
            if ($last != null) {
                $last_no = str_replace($prefix, "", $last);
                $last_no = (int) $last_no;
                $last_no++;
            } else {
                $last_no = 1;
            }


            $req_no = $prefix . str_pad($last_no, 5, '0', STR_PAD_LEFT);
            $model->request_no = $req_no;
        });
    }
}