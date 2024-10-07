<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Base64FileService
{


    static function saveBase64File($base64String, $folder = 'uploads')
    {
        // Check if the base64 string contains the file type prefix
        if (preg_match('/^data:(\w+\/\w+);base64,/', $base64String, $type)) {
            $data = substr($base64String, strpos($base64String, ',') + 1);
            $fileType = $type[1]; // e.g., "image/jpeg"
        } else {
            // Handle invalid base64 string
            throw new Exception('Invalid base64 string format.');
        }

        // Decode the base64 string
        $data = base64_decode($data);

        // Generate a unique file name with the correct extension
        $extension = Str::after($fileType, '/'); // e.g., "jpeg"
        $fileName = Str::uuid() . '.' . $extension;

        $visibility = config(
            "filesystems.disks." .
                config("filesystems.default") .
                ".visibility"
        );

        $visibility = $visibility == "public" ? "" : "public/";



        // Save the file to the specified folder
        $path = $visibility.$folder . '/' . $fileName;
        Storage::put($path, $data);

        return $path;
    }

}