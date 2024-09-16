<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

class ChangeLanguageController extends Controller
{
    public function changeLang($locale)
    {
        $app_locale = collect(config('locale.locales'))->where('code', $locale)->first();

        if ($app_locale != null) {
        
            session(['app_locale' => $app_locale]);
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
