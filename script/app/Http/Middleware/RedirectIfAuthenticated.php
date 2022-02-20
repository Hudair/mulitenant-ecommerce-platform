<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cache;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
         if($guard == "customer"){
            if (url('/') == env('APP_URL')) {
               Auth::logout();
               Auth::guard('customer')->logout();
            }
            $url= Auth::guard('customer')->user()->user_domain->full_domain ?? '';

            return redirect($url.'/user/dashboard');
         }  

         if (Auth::guard($guard)->check() && Auth::User()->role_id == 1) {
             return redirect(env('APP_URL').'/admin/dashboard');
         }
        elseif (Auth::guard($guard)->check() && Auth::User()->role_id == 2) {
           
           $url=  Auth::user()->user_domain->full_domain ?? env('APP_URL');
           
           return redirect($url.'/user/dashboard');
        }
        elseif(Auth::guard($guard)->check() && Auth::User()->role_id == 3)
        {
            

            if (Auth::user()->status==3) {
                $redirectTo=env('APP_URL').'/merchant/dashboard';
                return redirect($redirectTo);
            }
            elseif (Auth::user()->status === 0 || Auth::user()->status == 2) {
                $redirectTo=env('APP_URL').'/suspended';
                return redirect($redirectTo);
            }
            else{
               $url= Auth::user()->user_domain->full_domain ?? env('APP_APP_URL');
                if (str_replace('www.', '', url('/')) != $url) {
                 Auth::logout();
                 return redirect($url.'/login');
                }
                
               return redirect($url.'/seller/dashboard');
            }
           
            
        }
      }

    return $next($request);
    }
}
