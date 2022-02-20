<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthorMiddleware
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
        if (Auth::guard('customer')->check()) {
             
            $url= Auth::guard('customer')->user()->user_domain->full_domain ?? '';

            if($url != url('/')){
               
               Auth::guard('customer')->logout();
               return redirect()->route('login');
            }
           return $next($request);
        }else{
            if(Auth::check()){
                Auth::guard('customer')->logout();
                Auth::logout(); 
            }
            return redirect('user/login');
        } 
    }
}
