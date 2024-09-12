<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

class ChangeLanguageController extends Controller
{
    public function changeLang($locale)
    {
        if (in_array($locale, ['en', 'id'])) {
            session(['app_locale' => $locale]);
            App::setLocale($locale);
        }
        return redirect()->back();
    }
}
