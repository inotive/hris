<?php

namespace App\Traits;

use App\Models\User;

trait CreatedByUserTrait 
{
    protected $traitFillable = ['created_by_user_id'];

    public static function bootCreatedByUserTrait()
    {


        static::booted(function ($model) {
            $model->fillable = array_merge($model->fillable, (new static)->traitFillable);
        });

        static::creating(function($row){
            if ($row->created_by_user_id == null && auth()->user() instanceof User) $row->created_by_user_id = auth()->user()->id ?? null;
        });
    }
}