<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    public static function put($file, $folder, $filename)
    {
        
        $visibility = config(
            "filesystems.disks." .
                config("filesystems.default") .
                ".visibility"
        );

        $visibility = $visibility == "public" ? "" : "public/";

        Storage::putFileAs($visibility.$folder, $file, $filename);

        return $folder . '/' . $filename;

    }
}