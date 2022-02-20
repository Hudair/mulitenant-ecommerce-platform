<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Customdomain
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
        $check=domain_info('custom_domain');
        if ($check == true) {
           return $next($request);
        }
        die('custom domain modules not support in your plan');
    }
}
