<?php

namespace App\Traits;


trait CreatedByUserTrait 
{
    protected $traitFillable = ['created_by_user_id'];

    public static function bootCreatedByUserTrait()
    {


        static::booted(function ($model) {
            $model->fillable = array_merge($model->fillable, (new static)->traitFillable);
        });

        static::creating(function($row){
            $row->created_by_user_id = auth()->user()->id ?? null;
        });
    }
}