<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;
use Auth;
use App\Usermeta;
use App\Useroption;
use App\Category;
use App\Domain;
use App\Models\User;
use Hash;
class SettingController extends Controller
{
   

    public function settings_view(){
        return view('seller.settings');
    }

    public function profile_update(Request $request){
        
    $user=User::find(Auth::id());
      if ($request->password) {
           $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);  


           $check=Hash::check($request->password_current,auth()->user()->password);

           if ($check==true) {
              $user->password= Hash::make($request->password);
            }
        else{

            $returnData['errors']['password']=array(0=>"Enter Valid Password");
            $returnData['message']="given data was invalid.";
            
            return response()->json($returnData, 401);

        }        
    }
    else{
        $validatedData = $request->validate([
           'name' => 'required|max:255',
           'email'  =>  'required|email|unique:users,email,'.Auth::id()

       ]);
        $user->name=$request->name;
        $user->email=$request->email;   
    }
    $user->save();

    return response()->json(['Profile Updated Successfully']); 
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if ($request->type=='general') {
             $user_id=Auth::id();

             $validatedData = $request->validate([
                'shop_name' => 'required|max:20',
                'shop_description' => 'required|max:250',
                'store_email' => 'required|max:50|email',
                'order_prefix' => 'required|max:20',
                'currency_position' => 'required',
                'currency_name' => 'required|max:10',
                'currency_icon' => 'required|max:10',
                'lanugage' => 'required',
                'local' => 'required',
            ]);

            $shop_name= Useroption::where('user_id',$user_id)->where('key','shop_name')->first();
            if (empty($shop_name)) {
                $shop_name=new Useroption;
                $shop_name->key='shop_name';
            }
            $shop_name->value=$request->shop_name;
            $shop_name->user_id=$user_id;
            $shop_name->save();

            $shop_description= Useroption::where('user_id',$user_id)->where('key','shop_description')->first();
            if (empty($shop_description)) {
                $shop_description=new Useroption;
                $shop_description->key='shop_description';
            }
            $shop_description->value=$request->shop_description;
            $shop_description->user_id=$user_id;
            $shop_description->save();


            $store_email= Useroption::where('user_id',$user_id)->where('key','store_email')->first();
            if (empty($store_email)) {
                $store_email=new Useroption;
                $store_email->key='store_email';
            }
            $store_email->value=$request->store_email;
             $store_email->user_id=$user_id;
            $store_email->save();

            $order_prefix= Useroption::where('user_id',$user_id)->where('key','order_prefix')->first();
            if (empty($order_prefix)) {
                $order_prefix=new Useroption;
                $order_prefix->key='order_prefix';
            }
            $order_prefix->value=$request->order_prefix;
            $order_prefix->user_id=$user_id;
            $order_prefix->save();

            $local= Useroption::where('user_id',$user_id)->where('key','local')->first();
            if (empty($local)) {
                $local=new Useroption;
                $local->key='local';
            }
            $local->value=$request->local;
            $local->user_id=$user_id;
            $local->save();
            
            $order_receive_method= Useroption::where('user_id',$user_id)->where('key','order_receive_method')->first();
            if (empty($order_receive_method)) {
                $order_receive_method=new Useroption;
                $order_receive_method->key='order_receive_method';
            }
            $order_receive_method->value=$request->order_receive_method;
            $order_receive_method->user_id=$user_id;
            $order_receive_method->save();



            $currency= Useroption::where('user_id',$user_id)->where('key','currency')->first();
            if (empty($currency)) {
                $currency=new Useroption;
                $currency->key='currency';
            }
            $currencyInfo['currency_position']=$request->currency_position;
            $currencyInfo['currency_name']=$request->currency_name;
            $currencyInfo['currency_icon']=$request->currency_icon;

            $currency->value=json_encode($currencyInfo);
            $currency->user_id=$user_id;
            $currency->save();
            \Cache::forget(Auth::id().'currency_info');

            $langs=[];
            foreach ($request->lanugage as $key => $value) {
                $str=explode(',', $value);
                $langs[$str[0]]=$str[1];
            }
            $languages= Useroption::where('user_id',$user_id)->where('key','languages')->first();
            if (empty($languages)) {
                $languages=new Useroption;
                $languages->key='languages';
                $languages->user_id=$user_id;
            }
            $languages->value=json_encode($langs);
            $languages->save();

            $tax= Useroption::where('user_id',$user_id)->where('key','tax')->first();
            if (empty($tax)) {
                $tax=new Useroption;
                $tax->key='tax';
                $tax->user_id=$user_id;
            }
            $tax->value=$request->tax;
            $tax->save();
            \Cache::forget('tax'.Auth::id());
            
            $domain_id=domain_info('domain_id');
            $domain=Domain::find($domain_id);
            $domain->shop_type=$request->shop_type;
            $domain->save();
            //\Cache::forget('domain');

            return response()->json(['Settings Updated']);

       }

       if ($request->type=='location') {
        $user_id=Auth::id();
        $validatedData = $request->validate([
                'company_name' => 'required|max:20',
                'address' => 'required|max:250',
                'city' => 'required|max:20',
                'state' => 'required|max:20',
                'zip_code' => 'required|max:20',
                'email' => 'required|max:30',
                'phone' => 'required|max:15',
        ]);

         $location= Useroption::where('user_id',$user_id)->where('key','location')->first();
         if (empty($location)) {
            $location=new Useroption;
            $location->key='location';
         }
         $data['company_name']=$request->company_name;
         $data['address']=$request->address;
         $data['city']=$request->city;
         $data['state']=$request->state;
         $data['zip_code']=$request->zip_code;
         $data['email']=$request->email;
         $data['phone']=$request->phone;
         $data['invoice_description']=$request->invoice_description;

         $location->value=json_encode($data);
         $location->user_id=$user_id;
         $location->save();

         return response()->json(['Location Updated']);

       } 

       if ($request->type=='pwa_settings') {
        $user_id=Auth::id();
        $validatedData = $request->validate([
                'pwa_app_title' => 'required|max:20',
                'pwa_app_name' => 'required|max:15',
                'app_lang' => 'required|max:15',
                'pwa_app_background_color' => 'required|max:15',
                'pwa_app_theme_color' => 'required|max:15',
                'app_icon_128x128' => 'max:300|mimes:png',
                'app_icon_144x144' => 'max:300|mimes:png',
                'app_icon_152x152' => 'max:300|mimes:png',
                'app_icon_192x192' => 'max:300|mimes:png',
                'app_icon_512x512' => 'max:500|mimes:png',
                'app_icon_256x256' => 'max:400|mimes:png',
        ]);

        if ($request->app_icon_128x128) {
             $request->app_icon_128x128->move('uploads/'.$user_id, '128x128.png'); 
        }
        if ($request->app_icon_144x144) {
           $request->app_icon_144x144->move('uploads/'.$user_id, '144x144.png'); 
        }
        if ($request->app_icon_152x152) {
           $request->app_icon_152x152->move('uploads/'.$user_id, '152x152.png'); 
        }
        if ($request->app_icon_192x192) {
         $request->app_icon_192x192->move('uploads/'.$user_id, '192x192.png'); 
        }
        if ($request->app_icon_512x512) {
         $request->app_icon_512x512->move('uploads/'.$user_id, '512x512.png'); 
        }
        if ($request->app_icon_256x256) {
         $request->app_icon_256x256->move('uploads/'.$user_id, '256x256.png'); 
        }

        $mainfest='{
  "name": "'.$request->pwa_app_title.'",
  "short_name": "'.$request->pwa_app_name.'",
  "icons": [
    {
      "src": "'.asset('uploads/'.$user_id.'/192x192.png').'",
      "sizes": "128x128",
      "type": "image/png"
    },
    {
      "src": "'.asset('uploads/'.$user_id.'/144x144.png').'",
      "sizes": "144x144",
      "type": "image/png"
    },
    {
      "src": "'.asset('uploads/'.$user_id.'/152x152.png').'",
      "sizes": "152x152",
      "type": "image/png"
    },
    {
      "src": "'.asset('uploads/'.$user_id.'/192x192.png').'",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "'.asset('uploads/'.$user_id.'/256x256.png').'",
      "sizes": "256x256",
      "type": "image/png"
    },
    {
      "src": "'.asset('uploads/'.$user_id.'/512x512.png').'",
      "sizes": "512x512",
      "type": "image/png"
    }
  ],
  "lang": "'.$request->app_lang.'",
  "start_url": "/pwa",
  "display": "standalone",
  "background_color": "'.$request->pwa_app_background_color.'",
  "theme_color": "'.$request->pwa_app_theme_color.'"
}';

\File::put('uploads/'.$user_id.'/manifest.json',$mainfest);

return response()->json(['Update success']);
       } 
       if ($request->type=='theme_settings') {
        $user_id=Auth::id();
        $validatedData = $request->validate([
                'theme_color' => 'required|max:50',
                'logo' => 'max:1000|mimes:png',
                'favicon' => 'max:100|mimes:ico',
        ]);

         $theme_color= Useroption::where('user_id',$user_id)->where('key','theme_color')->first();
         if (empty($theme_color)) {
            $theme_color=new Useroption;
            $theme_color->key='theme_color';
         }

        if ($request->logo) {
             $request->logo->move('uploads/'.$user_id, 'logo.png'); 
        }

        if ($request->favicon) {
             $request->favicon->move('uploads/'.$user_id, 'favicon.ico'); 
        }
        

         $theme_color->value=$request->theme_color;
         $theme_color->user_id=$user_id;
         $theme_color->save();


         $social= Useroption::where('user_id',$user_id)->where('key','socials')->first();
         if (empty($social)) {
            $social=new Useroption;
            $social->key='socials';
         }

         $links=[];
         foreach ($request->icon ?? [] as $key => $value) {
            $data['icon']=$value;
            $data['url']=$request->url[$key];
            array_push($links, $data);
         }
        
         $social->value=json_encode($links);
         $social->user_id=$user_id;
         $social->save();
         

         return response()->json(['Theme Settings Updated']);
         
       }

       if ($request->type=='css') {
        $user_id=Auth::id();
        $plan=user_limit();
        if (filter_var($plan['custom_css'])==true) {
           \File::put('uploads/'.$user_id.'/additional.css',$request->css);
           return response()->json(['Updated success']);
        }
        

       }

       if ($request->type=='js') {
        $user_id=Auth::id();
         $plan=user_limit();
        if (filter_var($plan['custom_js'])==true) {
        \File::put('uploads/'.$user_id.'/additional.js',$request->js);
        return response()->json(['Updated success']);
        }
       }

       abort(404);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if ($slug=='shop-settings') {
            $user_id=Auth::id();

            $langlist=\App\Option::where('key','languages')->first();
            $langlist=json_decode($langlist->value ?? '');

            $languages= Useroption::where('user_id',$user_id)->where('key','languages')->first();
            $active_languages= json_decode($languages->value ?? '');
            $my_languages=[];
            foreach ($active_languages ?? [] as $key => $value) {
                array_push($my_languages, $value);
            }

            $shop_name=Useroption::where('key','shop_name')->where('user_id',$user_id)->first();
            $shop_description=Useroption::where('key','shop_description')->where('user_id',$user_id)->first();
            $store_email=Useroption::where('key','store_email')->where('user_id',$user_id)->first();
            $order_prefix=Useroption::where('key','order_prefix')->where('user_id',$user_id)->first();
            $currency=Useroption::where('key','currency')->where('user_id',$user_id)->first();
            $location=Useroption::where('key','location')->where('user_id',$user_id)->first();
            $theme_color=Useroption::where('key','theme_color')->where('user_id',$user_id)->first();
            $currency=json_decode($currency->value ?? '');
            $location=json_decode($location->value ?? '');
            $tax= Useroption::where('user_id',$user_id)->where('key','tax')->first();
            $local= Useroption::where('user_id',$user_id)->where('key','local')->first();
            $socials= Useroption::where('user_id',$user_id)->where('key','socials')->first();
            $local=$local->value ?? ''; 
            $socials=json_decode($socials->value ?? ''); 
            if (file_exists('uploads/'.Auth::id().'/manifest.json')) {
              $pwa=file_get_contents('uploads/'.Auth::id().'/manifest.json');
              $pwa=json_decode($pwa);
            }
            else{
                $pwa=[];
            }
            
            $order_receive_method= Useroption::where('user_id',$user_id)->where('key','order_receive_method')->first();
            $order_receive_method= $order_receive_method->value ?? 'email';
            

            if (file_exists('uploads/'.Auth::id(). '/additional.js')) {
                $js=file_get_contents('uploads/'.Auth::id().'/additional.js');
            }
            else{
                $js='';
            }

            if (file_exists('uploads/'.Auth::id(). '/additional.css')) {
                $css=file_get_contents('uploads/'.Auth::id().'/additional.css');
            }
            else{
                $css='';
            }

           return view('seller.settings.general',compact('shop_name','order_receive_method','shop_description','store_email','order_prefix','currency','location','theme_color','langlist','my_languages','tax','local','socials','pwa','js','css'));
        } 
        if ($slug=='payment') {
            abort_if(!\Route::has('admin.plan.index'),404);
            $posts=Category::with('description','active_getway')->where('type','payment_getway')->where('slug','!=','cod')->get();
            $cod=Category::with('description','active_getway')->where('type','payment_getway')->where('slug','cod')->get();
           return view('seller.settings.payment_method',compact('posts','cod'));
        }
        if ($slug=='plan') {
            abort_if(!\Route::has('admin.plan.index'),404);
            $posts=Plan::where('status',1)->where('is_default',0)->where('is_trial',0)->where('price','>',0)->latest()->get();
            return view('seller.plan.index',compact('posts'));
        }

        return back();
    }

    public function support_view()
    {
        $plan_limit=user_limit();
        if(filter_var($plan_limit['live_support'],FILTER_VALIDATE_BOOLEAN) != true){
           return redirect('/seller/dashboard');
        }
        return view('seller.settings.support');
    }

   
}
