<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Customers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (false == Auth::guard('customer')->check()) {
            return redirect('/user/login');
        }

        return $next($request);
    }
}
