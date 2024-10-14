<?php

namespace App\Traits;

use App\Services\Base64FileService;
use Illuminate\Support\Facades\Log;

trait UploadBase64File 
{

    public static function bootUploadBase64File()
    {
        static::saving(function($model){
            $fillable = $model->fillable ?? [];

         

            foreach($fillable as $key => $field) {
                $val = $model->$field;


                if ($val != null && self::isBase64EncodedFile($val)) {
                    $base64file = Base64FileService::saveBase64File($val, $field);
                    $model->$field = $base64file;

                }
            }
        });
    }


    private static function isBase64EncodedFile($string)
    {
        if (preg_match('/^data:(\w+\/\w+);base64,/', $string, $type)) {
            $data = substr($string, strpos($string, ',') + 1);
            $fileType = $type[1]; // e.g., "image/jpeg"
            return true;
        } else {
            // Handle invalid base64 string
            return false;
        }
    }
}