<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;

class CheckAuhRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();


        $route = \Route::currentRouteName();

        $check_route = AuthService::isValid($route);

        // dd($check_route);

        if ($user && $check_route == false) {
            // Redirect to a password change page if the password has not been changed
            return abort(403);
        }

        return $next($request);
    }
}
