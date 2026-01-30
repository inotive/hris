<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CheckPasswordChanged
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

        // Check if the user is authenticated and their password has been changed
        $except = [
            'user.change-password',
            'user.change-password.update',
            'login',
        ];
        if ($user && $user->password_updated_at == null && in_array(\Route::currentRouteName(), $except) == false) {
            // Redirect to a password change page if the password has not been changed
            return redirect()->route('user.change-password');
        }

        return $next($request);
    }
}
