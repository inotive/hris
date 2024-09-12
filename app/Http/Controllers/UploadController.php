<?php

namespace App\Http\Controllers;

use App\Helpers\Base64ImageHelper;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            $file = UploadService::put($file, $request->folder, $filename);
         
            $url = Storage::url($file);
            if (str_contains('http', $url)) {
                $url = $url;
            } else {
                $url = asset($url);
            }
            return response()->json([
                'file' => $file,
                'url'   => $url,
            ]);
        }
        return response()->json(['error' => 'No file uploaded.']);
    }
}
