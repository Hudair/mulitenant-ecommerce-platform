<?php 
namespace App\Helper\Sitehelper;
use Cache;
use CURLFile;
class Sitehelper
{
	public static $domain;
	public static $full_domain;

	public static function domain($domain,$full_domain)
	{

		Sitehelper::$domain=$domain;
		Sitehelper::$full_domain=$full_domain;
		$domain_info=domain_info();
		
		if ($full_domain==env('APP_URL')) {
			if (Cache::has('domain')) {
			  Cache::forget('domain');
		    }
			return true;
		}
		if ($domain_info != false) {
			
			if ($domain_info['domain_name'] != $domain) {
				
				Cache::forget('domain');
				return Sitehelper::domain($domain,$full_domain);
			}
		}			
		
		if (!Cache::has('domain')) {

			$value = Cache::remember('domain', 300,function () {
				$data=\App\Domain::where('domain',Sitehelper::$domain)->where('status',1)->with('theme')->first();
				if (empty($data)) {
					die();
				}
				
				$info['domain_id']=$data->id;
				$info['user_id']=$data->user_id;
				$info['domain_name']= Sitehelper::$domain;
				$info['full_domain']= Sitehelper::$full_domain;
				$info['view_path']=$data->theme->src_path;
				$info['asset_path']=$data->theme->asset_path;
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

}