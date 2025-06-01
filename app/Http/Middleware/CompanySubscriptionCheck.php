<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class CompanySubscriptionCheck
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
        try{
            $user = auth()->user();
            if ($user->role != 'superadmin') {
                $active = $user->company->active_subscriptions() ?? [];
                if (count($active) <= 0) {
    //                return redirect()->route('no-active-subscription');

                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();


                    $message = __('dashboard.no_active_subscription');

                    return redirect('/login?message=' . $message);
                }
            }

            return $next($request);
        }catch(Exception $e){
            
            Log::info($e->getMessage());

            $message = __('dashboard.no_active_subscription');

            return redirect('/login?message=' . $message);


            return $next($request);
        }
   
    }
}
