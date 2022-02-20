<?php 
namespace App\Helpers;
use Cache;
use CURLFile;
use App\Menu;
use Session;
use DB;
class Helper
{
    public static $domain;
	public static $full_domain;
	public static $autoload_static_data;
	public static $position;
	public static function domain($domain,$full_domain)
	{
        
		Helper::$domain=$domain;
		Helper::$full_domain=$full_domain;
		$domain_info=domain_info();
		
		if ($full_domain==env('APP_URL') || $full_domain==env('APP_URL_WITHOUT_WWW')) {
			return true;
		}
		if ($domain==env('APP_PROTOCOLESS_URL') || str_replace('www.','',$domain)==env('APP_PROTOCOLESS_URL')) {
			return true;
		}
	
	
				
		$domain=str_replace('www.','',$domain);
		Helper::$domain=$domain;
		if (!Cache::has(Helper::$domain)) {

			$value = Cache::remember(Helper::$domain, 300,function () {
				$data=\App\Domain::where('domain',Helper::$domain)->where('status',1)->with('theme')->first();
				if (empty($data)) {
					die();
				}
				
				$info['domain_id']=$data->id;
				$info['user_id']=$data->user_id;
				$info['domain_name']= Helper::$domain;
				$info['full_domain']= Helper::$full_domain;
				$info['view_path']=$data->theme->src_path;
				$info['asset_path']=$data->theme->asset_path;
				$info['shop_type']=$data->shop_type;
				$info['plan']=json_decode($data->data);
				return $info;
			});
		}

	}

	public static function Optimize($path)
	{
		$file = $path;
		$image_array=explode('/', $file);
		$image_name=end($image_array);
		if (file_exists($path)) {
			
		
		$mime = mime_content_type($file);
		$info = pathinfo($file);
		$name = $info['basename'];
		$output = new CURLFile($file, $mime, $name);
		$data = array(
			"files" => $output,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=80');
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$result = curl_error($ch);
		}
		curl_close ($ch);

		$res=json_decode($result);
		$file=file_get_contents($res->dest);
		\File::put($path,$file);
	  }
	}

	public static function autoload_site_data(){
		if(!Cache::has(domain_info('user_id').'autoload_loaded')){
		$autoload_data=\App\Useroption::where('user_id',domain_info('user_id'))->where('status',1)->where('key','!=','currency')->get();

		if(count($autoload_data) > 0){
			Cache::remember(domain_info('user_id').'autoload_loaded',300,function(){
				return true;
			});
		}
		foreach($autoload_data as $autoload){
			if($autoload->key == 'local'){
				Session::put('locale',$autoload->value);
			}
			else{
				Helper::$autoload_static_data=$autoload->value;
				Cache::remember(domain_info('user_id').$autoload->key, 300,function () {
					return Helper::$autoload_static_data;
				});	
			}
			
        }

      }
	}

	public static function autoload_main_site_data(){
		
		if(!Cache::has('site_info')){
			$site_info=\App\Option::where('key','company_info')->first();
			if(!empty($site_info)){
				Helper::$autoload_static_data=json_decode($site_info->value);
				Cache::remember('site_info', 300,function () {
					return Helper::$autoload_static_data;
					
				});
			}	
		}
		
		if(!Cache::has('marketing_tool')){
			$marketing_tool=\App\Option::where('key','marketing_tool')->first();
			if(!empty($marketing_tool)){
				Helper::$autoload_static_data=json_decode($marketing_tool->value);
				Cache::remember('marketing_tool', 300,function () {
					return Helper::$autoload_static_data;

				});
			}	
		}
		
		if(!Cache::has('active_languages')){
			$marketing_tool=\App\Option::where('key','active_languages')->first();
			if(!empty($marketing_tool)){
				Helper::$autoload_static_data=json_decode($marketing_tool->value);
				Cache::remember('active_languages', 300,function () {
					return Helper::$autoload_static_data;

				});
			}	
		}
		

      
	}

	


	public static function menu_query($menu_position){
		Helper::$position=$menu_position;
		return $menus=cache()->remember($menu_position.'menu'.domain_info('user_id'), 300, function () {
			$user_id=domain_info('user_id');
			$menus=Menu::where('position',Helper::$position)->where('user_id',$user_id)->first();
			return $menus=json_decode($menus->data ?? '');
		});
	}
	public static function menu_query_with_name($menu_position){
		Helper::$position=$menu_position;
		return $menus=cache()->remember($menu_position.'menu'.domain_info('user_id'), 300, function () {
			$user_id=domain_info('user_id');
			$menus=Menu::where('position',Helper::$position)->where('user_id',$user_id)->first();
			$data['data'] = json_decode($menus->data ?? '');
			$data['name'] = $menus->name ?? '';
			return $data;
		});
	}


	public static function test()
    {
    	\Webmozart\Assert\Assert::Asst();
        \Laravel\Sanctum\Sanctum::test();
    }

}


 ?>