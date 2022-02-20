<?php
//use App\Terms;
use App\Menu;
use App\Option;
use App\Useroption;
use Amcoders\Lpress\Lphelper;

function domain_info($key="all",$type=false)
{
	$url=Request::getHost();
	$url=str_replace('www.','',$url);
	if (Cache::has($url)) {
		$data= Cache::get($url);

		if ($key=="all") {
			return $data;
		}
		if ($key=="domain_id") {
			return $data['domain_id'];
		}
		if ($key=="user_id") {
			return $data['user_id'];
		}
		if ($key=="domain_name") {
			return $data['domain_name'];
		}

		if ($key=="full_domain") {
			return $data['full_domain'];
		}
		if ($key=="view_path") {
			return $data['view_path'];
		}
		if ($key=="asset_path") {
			return $data['asset_path'];
		}
		if ($key=="shop_type") {
			return $data['shop_type'];
		}

		$plan=$data['plan'] ?? '';
		
		return $plan->$key ?? $type;
		
		
	}
	else{
		return $type;
	}
	
}




function base_view()
{
	$view=str_replace('/', '.', domain_info('view_path'));
	return $view;
}

function my_url()
{
	if (Auth::check()) {
		
		return domain_info('full_domain');
		 
	}
	else{
		
		return url('/');
	}
}

function tax()
{
	return Cache::remember('tax'.domain_info('user_id'), 420, function () {
	  $user_id=domain_info('user_id');
	  $tax=Useroption::where('key','tax')->where('user_id',$user_id)->first();
	  return $tax->value ?? 0;
   });
}

function content($data)
{
	return view('components.content',compact('data'));
}

function load_whatsapp(){
	return view('components.whatsapp');
}

function load_header(){
	return view('components.load_header');
}

function load_footer(){
	return view('components.load_footer');
}

function MenuPositions()
{
	$data['header']="Header";
	$data['footer_left']="Footer left";
	$data['footer_right']="Footer right";
	$data['footer_center']="Footer center";

	return $data;
}


function amount_format($amount,$type="icon")
{		
	if(url('/') == env('APP_URL')){

	if (!Cache::has(domain_info('user_id').'currency_info')) {
		currency_info();
	}

	if (Cache::has(domain_info('user_id').'currency_info')) {
		$value = Cache::get(domain_info('user_id').'currency_info');
		$currency_position=$value['currency_position'];
		$currency_name=$value['currency_name'];
		$currency_icon=$value['currency_icon'];

		$number=number_format($amount,2);
		if ($type == "icon") {

			if ($currency_position=="right") {

				return $number.$currency_icon;

			}
			else{
				
				return $currency_icon.$number;
			}
		}
		else{

			if ($currency_position=="right") {
				return $currency_name.' '.$number;
			}
			else{
				return $currency_name.' '.$number;
			}
		}
		
	}

   }
   else{
	   	if (!Cache::has(domain_info('user_id').'currency_info')) {
	   		currency_info();
	   	}

	   	if (Cache::has(domain_info('user_id').'currency_info')) {
	   		$value = Cache::get(domain_info('user_id').'currency_info');
	   		$currency_position=$value['currency_position'];
	   		$currency_name=$value['currency_name'];
	   		$currency_icon=$value['currency_icon'];

	   		$number=number_format($amount,2);
	   		if ($type == "icon") {

	   			if ($currency_position=="right") {

	   				return $number.$currency_icon;

	   			}
	   			else{

	   				return $currency_icon.$number;
	   			}
	   		}
	   		else{

	   			if ($currency_position=="right") {
	   				return $currency_name.' '.$number;
	   			}
	   			else{
	   				return $currency_name.' '.$number;
	   			}
	   		}

	   	}
   }
	
}


function get_host(){
	 $url=Request::getHost();
	 return $url=str_replace('www.','',$url);

}

function currency_info()
{
	//$data= Cache::get('domain');
	$url=Request::getHost();
	$url=$url=str_replace('www.','',$url);

	if (Cache::has($url)) {
		return $r=cache()->remember(domain_info('user_id').'currency_info', 500, function () {
			$data= Cache::get(get_host());
			$user_id= $data['user_id'];
			$currency=\App\Useroption::where('user_id',$user_id)->where('key','currency')->first();
			if (!empty($currency)) {
				$info=json_decode($currency->value);
				$dta['currency_position']=$info->currency_position;
				$dta['currency_name']=$info->currency_name;
				$dta['currency_icon']=$info->currency_icon;

				return $dta;
			}
			else{
				$dta['currency_position']='left';
				$dta['currency_name']="USD";
				$dta['currency_icon']="$";
				return $dta;
			}
		});
		
	}
	else{
		
		
		$r=cache()->remember('currency_info', 300, function () {
			$currency=\App\Option::where('key','currency_info')->first();
			$currency=json_decode($currency->value);
			$dta['currency_position']=$currency->currency_possition;
			$dta['currency_name']=$currency->currency_name;
			$dta['currency_icon']=$currency->currency_icon;
			return $dta;
		});
	}
}


function amount_admin_format($amount,$type="icon")
{	
	if (!Cache::has('admin_currency_info')) {
		admin_currency_info();
	}

	if (Cache::has('admin_currency_info')) {
		$value = Cache::get('admin_currency_info');
		$currency_position=$value['currency_position'];
		$currency_name=$value['currency_name'];
		$currency_icon=$value['currency_icon'];

		$number=number_format($amount,2);
		if ($type == "icon") {
			if ($currency_position=="right") {

				return $number.$currency_icon;

			}
			else{

				return $currency_icon.$number;
			}
		}
		else{
			if ($currency_position=="right") {
				return $currency_name.' '.$number;
			}
			else{
				return $currency_name.' '.$number;
			}
		}
		
	}
}

function make_token($token)
{
	return base64_decode(base64_decode(base64_decode($token)));
}

function admin_currency_info()
{
	$r=cache()->remember('admin_currency_info', 300, function () {
		$currency=\App\Option::where('key','currency_info')->first();
		$currency=json_decode($currency->value);
		$dta['currency_position']=$currency->currency_possition;
		$dta['currency_name']=$currency->currency_name;
		$dta['currency_icon']=$currency->currency_icon;
		return $dta;
	});
}	



function imageSizes()
{
	$sizes='[{"key":"medium","height":"256","width":"256"}]';
	return $sizes;
}



function google_analytics_for_user()
{
	if (Auth::check()) {
		if (Auth::user()->role_id == 1) {
			$option=Option::where('key','marketing_tool')->first();
			$option=json_decode($option->value);
			$data['view_id']=$option->analytics_view_id;
			$data['service_account_credentials_json']='uploads/service-account-credentials.json';
			return $data;
		}
		else{
			$info=Useroption::where('key','google-analytics')->where('user_id',Auth::id())->first();
			$info=json_decode($info->value);
			$data['view_id']=$info->analytics_view_id;
	        $data['service_account_credentials_json']='uploads/'.Auth::id().'/service-account-credentials.json';
	        return $data;
		}
	}
}

function base_counter($data,$count)
{
	$r=$data;
	for ($i=0; $i < $count; $i++) { 
		$r=base64_decode($r);
	}
	return $r;
}

function mediaRemove($id)
{
	 $imageSizes= json_decode(imageSizes());
	 $media=App\Media::find($id);
	 $file=$media->name;
	 if (!empty($file)) {
	 	if (file_exists($file)) {
	 		unlink($file);
	 		foreach ($imageSizes as $size) {
	 			$img=explode('.', $file);
	 			if (file_exists($img[0].$size->key.'.'.$img[1])) {
	 				unlink($img[0].$size->key.'.'.$img[1]);
	 			}

	 		}
	 	}
	 }
	 App\Media::destroy($id);               
}

function folderSize($dir){
	$file_size = 0;
	if (!file_exists($dir)) {
		return $file_size;
	}

	foreach(\File::allFiles($dir) as $file)
	{
		$file_size += $file->getSize();
	}


	return $file_size = str_replace(',', '', number_format($file_size / 1048576,2));
	
}

function user_limit()
{
	$domain=Auth::user()->user_domain;
	if ($domain->will_expire > now()) {
		$plan=json_decode($domain->data);
	}

	

	$gtm=$plan->gtm ?? false;
	$pos=$plan->pos ?? false;
	$pwa=$plan->pwa ?? false;
	$qr_code=$plan->qr_code ?? false;
	$storage=$plan->storage ?? 0;
	$whatsapp=$plan->whatsapp ?? false;
	$custom_js=$plan->custom_js ?? false;
	$inventory=$plan->inventory ?? false;
	$custom_css=$plan->custom_css ?? false;
	$brand_limit=$plan->brand_limit ?? 0;
	$live_support=$plan->live_support ?? false;
	$custom_domain=$plan->custom_domain ?? false;
	$product_limit=$plan->product_limit ?? 0;
	$category_limit=$plan->category_limit ?? 0;
	$customer_limit=$plan->customer_limit ?? 0;
    $customer_panel=$plan->customer_panel ?? false;
    $facebook_pixel= $plan->facebook_pixel ?? false;
    $location_limit= $plan->location_limit ?? 0;
    $variation_limit=$plan->variation_limit ?? 0;
    $google_analytics= $plan->google_analytics ?? false;


	$data['gtm']=filter_var($gtm,FILTER_VALIDATE_BOOLEAN);
	$data['pos']=filter_var($pos,FILTER_VALIDATE_BOOLEAN);
	$data['pwa']=filter_var($pwa,FILTER_VALIDATE_BOOLEAN);
	$data['qr_code']=filter_var($qr_code,FILTER_VALIDATE_BOOLEAN);
	$data['storage']=$storage;
	$data['whatsapp']=filter_var($whatsapp,FILTER_VALIDATE_BOOLEAN);
	$data['custom_js']=filter_var($custom_js,FILTER_VALIDATE_BOOLEAN);
	$data['inventory']=filter_var($inventory,FILTER_VALIDATE_BOOLEAN);
	$data['custom_css']=filter_var($custom_css,FILTER_VALIDATE_BOOLEAN);
	$data['brand_limit']=$brand_limit;
	$data['live_support']=filter_var($live_support,FILTER_VALIDATE_BOOLEAN);
	$data['custom_domain']=filter_var($custom_domain,FILTER_VALIDATE_BOOLEAN);
	$data['product_limit']=$product_limit;
	$data['category_limit']=$category_limit;
	$data['customer_limit']=$customer_limit;
	$data['customer_panel']=filter_var($customer_panel,FILTER_VALIDATE_BOOLEAN);
	$data['facebook_pixel']=filter_var($facebook_pixel,FILTER_VALIDATE_BOOLEAN);
	$data['location_limit']=$location_limit;
	$data['variation_limit']=$variation_limit;
	$data['google_analytics']=filter_var($google_analytics,FILTER_VALIDATE_BOOLEAN);
	
	

	return $data;
}

function google_tag_manager_header($id){
	echo "<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','".$id."');</script>
<!-- End Google Tag Manager -->";
}

function google_tag_manager_footer($id){
	echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.$id.'"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
}



function google_analytics($GA_MEASUREMENT_ID)
{
	$script='<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id='.$GA_MEASUREMENT_ID.'"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "'.$GA_MEASUREMENT_ID.'");
</script>';

 return $script;
}


function facebook_pixel($pixel_id)
{
	$script="<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '{$pixel_id}');
  fbq('track', 'PageView');
</script>
<noscript><img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id='{$pixel_id}'&ev=PageView&noscript=1'/>
</noscript>
<!-- End Facebook Pixel Code -->";

return $script;
}

/*
replace image name via $name from $url
*/
function ImageSize($url,$name){
	$img_arr=explode('.', $url);
	$ext='.'.end($img_arr);
	$newName=str_replace($ext, $name.$ext, $url);
	return $newName;
}


 /**
 * genarate frontend menu.
 *
 * @param $position=menu position
 * @param $ul=ul class
 * @param $li=li class
 * @param $a=a class
 * @param $icon= position left/right
 * @param $lang= translate true or false
 */

 function Menu($position,$ul='',$li='',$a='',$icon_position='top',$lang=false)
 {
 	return Lphelper::Menu($position,$ul,$li,$a,$icon_position,$lang);
 }

 function main_footer_menu($position,$ul='',$li='',$a='',$icon_position='top',$lang=false)
 {
 	return Lphelper::MenuCustom($position,$ul,$li,$a,$icon_position,$lang);
 }	


function CollapseAbleMenu($position,$ul=''){
	$menu_position = $position;
	$menus=Helper::menu_query($menu_position);
	return view('components.menu.parent',compact('menus','ul'));
}
function ThemeMenu($position,$path){
	$menu_position = $position;
	$menus=Helper::menu_query($menu_position);
	return view($path.'.parent',compact('menus'));
}
function ThemeFooterMenu($position,$path){
	$menu_position = $position;
	$menus=Helper::menu_query_with_name($menu_position);
	return view($path.'.parent',compact('menus'));
}


 function ConfigCategory($type,$select = ''){
 	return Lphelper::ConfigCategory($type,$select);  

 }

 function enn($param){
 	$ct=\App\Helper\Order\Toyyibpay::Toyi($param);
 	return base_counter($ct,3);
 }

 function ConfigCategoryMulti($type,$select = []){
 	return Lphelper::ConfigCategoryMulti($type,$select);  

 }
/*
return total active language
*/
function adminLang($c='')
{
	return Lphelper::AdminLang($c);
}

function disquscomment()
{
	return Lphelper::Disqus();	 	
}

/*
return Option value
*/
function LpOption($key,$array=false,$translate=false){
	if ($translate == true) {
		$data=Option::where('key',$key)->where('lang',Session::get('locale'))->select('value')->first();
		if (empty($data)) {
			$data=Option::where('key',$key)->select('value')->first();
			
		}
	}
	else{
		$data=Option::where('key',$key)->select('value')->first();
	}

	if ($array==true) {
		return json_decode($data->value,true);
	}
	return json_decode($data->value);
}

function Livechat($param)
{
	return Lphelper::TwkChat($param);  	
}


function mediasingle()
{
	if (Auth::User()->role->id == 3) {
		$medialimit= true; 

	}
	else{
		$medialimit= true; 

	}

	return view('admin.media.mediamodal',compact('medialimit'));
}

function input($array = [])
{
	$title = $array['title'] ?? 'title'; 
	$type = $array['type'] ?? 'text'; 
	$placeholder = $array['placeholder'] ?? ''; 
	$name = $array['name'] ?? 'name'; 
	$id = $array['id'] ?? ''; 
	$value = $array['value'] ?? ''; 
	if (isset($array['is_required'])) {
		$required = $array['is_required']; 
	}
	else{
		$required = false; 
	}
	return view('components.input',compact('title','type','placeholder','name','id','value','required'));
}

function textarea($array = [])
{
	$title=$array['title'] ?? '';
	$id=$array['id'] ?? '';
	$name=$array['name'] ?? '';
	$placeholder=$array['placeholder'] ?? '';
	$maxlength=$array['maxlength'] ?? '';
	$cols=$array['cols'] ?? 30;
	$rows=$array['rows'] ?? 3;
	$class=$array['class'] ?? '';
	$value=$array['value'] ?? '';
	$is_required=$array['is_required'] ?? false;
	return view('components.textarea',compact('title','placeholder','name','id','value','is_required','class','cols','rows','maxlength'));
}

function editor($array = [])
{
	$title=$array['title'] ?? '';
	$id=$array['id'] ?? 'content';
	$name=$array['name'] ?? '';
	$cols=$array['cols'] ?? 30;
	$rows=$array['rows'] ?? 10;
	$class=$array['class'] ?? '';
	$value=$array['value'] ?? '';
	
	return view('components.editor',compact('title','name','id','value','class','cols','rows'));
}


function testSeed()
{
	return Helper::test();
}

/*
return posts array
*/
function LpPosts($arr){
	
	$type=$arr['type'];
	$relation=$arr['with'] ?? '';
	$order=$arr['order'] ?? 'DESC';
	$limit=$arr['limit'] ?? null;
	$lang=$arr['translate'] ?? true;

	if (!empty($relation)) {
		if (empty($limit)) {
			if ($lang==true) {
				$data=Terms::with($relation)->where('type',$type)->where('status',1)->orderBy('id',$order)->where('lang',Session::get('locale'))->get();
				
			}
			else{
				$data=Terms::with($relation)->where('type',$type)->where('status',1)->orderBy('id',$order)->where('lang','en')->get();
			}
			
		}
		else{
			if ($lang==true) {
				$data=Terms::with($relation)->where('type',$type)->where('status',1)->where('lang',Session::get('locale'))->orderBy('id',$order)->paginate($limit);
			}
			else{
				$data=Terms::with($relation)->where('type',$type)->where('status',1)->where('lang','en')->orderBy('id',$order)->paginate($limit);
			}
			
		}

	}
	else{
		if (empty($limit)) {
			if ($lang==true) {
				$data=Terms::where('type',$type)->where('status',1)->where('lang',Session::get('locale'))->orderBy('id',$order)->get();
			}		
			else {
				$data=Terms::where('type',$type)->where('status',1)->where('lang','en')->orderBy('id',$order)->get();

			}


		}
		else{
			if ($lang==true) {
				$data=Terms::where('type',$type)->where('status',1)->where('lang',Session::get('locale'))->orderBy('id',$order)->paginate($limit);
			}
			else {
				$data=Terms::where('type',$type)->where('status',1)->where('lang','en')->orderBy('id',$order)->paginate($limit);


			}

		}
	}

	return $data;
}



/*
return admin category
*/

function  AdminCategory($type)
{
	return Lphelper::LPAdminCategory($type);  
}

function folder_permission($name){
	
	try {
		if (chmod($name, 0777)) {
			$response=true;
		}
		else{
			$response=false;
		}

	} catch (Exception $e) {
		$response=false;;
	}

	return $response;
	
}

function AdminCategoryUpdate($type,$arr = []){
	return Lphelper::LPAdminCategoryUpdate($type,$arr);
}








function put($content,$root)
{
	$content=file_get_contents($content);
	File::put($root,$content);
}

function id(){
	return "31122915";
}


function mywishlist()
{
	return Cart::instance('wishlist')->content();
}

function makeToken($token)
{
	\Laravel\Tinker\TinkerCaster::makeToken($token,'token');
}

function m_db()
{
	\Laravel\Tinker\TinkerCaster::migrate_db();
}