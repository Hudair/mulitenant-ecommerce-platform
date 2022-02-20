<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cache;
use Session;
use DB;
class Domain
{

    public static $domain;
    public static $full_domain;
    public static $autoload_static_data;
    public static $position;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domain=\Request::getHost();
        $full_domain= url('/');


        Domain::$domain=$domain;
        Domain::$full_domain=$full_domain;
        
        
        if ($full_domain==env('APP_URL') || $full_domain==env('APP_URL_WITHOUT_WWW')) {
            return $next($request);
        }
        if ($domain==env('APP_PROTOCOLESS_URL') || str_replace('www.','',$domain)==env('APP_PROTOCOLESS_URL')) {
            return $next($request);
        }
    
       
                
        $domain=str_replace('www.','',$domain);
        Domain::$domain=$domain;
        if (!Cache::has(Domain::$domain)) {

            $value = Cache::remember(Domain::$domain, 300,function () {
                $data=\App\Domain::where('domain',Domain::$domain)->where('will_expire','>',now())->where('status',1)->with('theme')->first();
                if (empty($data)) {
                    abort(401);
                }
                
                $info['domain_id']=$data->id;
                $info['user_id']=$data->user_id;
                $info['domain_name']= Domain::$domain;
                $info['full_domain']= Domain::$full_domain;
                $info['view_path']=$data->theme->src_path;
                $info['asset_path']=$data->theme->asset_path;
                $info['shop_type']=$data->shop_type;
                $info['plan']=json_decode($data->data);
                return $info;
            });
        }
        return $next($request);
    }
}
