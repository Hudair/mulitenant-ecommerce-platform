<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Auth;
use Cache;
class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::User()->role_id == 3) {
         if (Auth::user()->status==3) {
           return redirect(env('APP_URL').'/merchant/dashboard');
          }
          if (Auth::user()->status === 0 || Auth::user()->status == 2) {
            return redirect(env('APP_URL').'/suspended');
          }
          if (url('/') == env('APP_URL') && Auth::user()->status == 1) {
           Auth::logout();
           return redirect()->route('login');
          }
          
          $url= Auth::user()->user_domain->full_domain ?? env('APP_APP_URL');

          if($url != str_replace('www.', '', url('/'))){
            Auth::logout();
            return redirect()->route('login');
          }
         

           return $next($request);
        }else{
            return redirect()->route('login');
        } 
    }
}
