<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
        {if(! $request->user()) {
            return $next($request);
        }

        $language = session('app_locale')['code'] ?? 'en';

        if (isset($language)) {
            $app_locale = collect(config('locale.locales'))->where('code', $language)->first();
            session(['app_locale' => $app_locale]);
            app()->setLocale($language);
        }
        
        return $next($request);
    }
}
