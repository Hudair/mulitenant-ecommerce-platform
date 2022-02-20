<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Useroption;
class MarketingController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $plan=user_limit();
         
       if ($request->type=='google-analytics') {
           
        
          
            $google_analytics=filter_var($plan['google_analytics']);
            if($google_analytics == false){
               $msg='This module did not support your subscription.';
               $error['errors']['error']=$msg;
               return response()->json($error,401);
               
            } 


            $validatedData = $request->validate([
                'ga_measurement_id' => 'required|max:50',
                'analytics_view_id' => 'required|max:50',
                'file' => 'mimes:json|max:50',

            ]);

           $google= Useroption::where('user_id',Auth::id())->where('key','google-analytics')->first();
           if (empty($google)) {
               $google = new Useroption;
               $google->user_id=Auth::id();
               $google->key="google-analytics";
           }

           $data['ga_measurement_id']=$request->ga_measurement_id;
           $data['analytics_view_id']=$request->analytics_view_id;

           $google->value=json_encode($data);
           $google->status=$request->status;
           $google->save();

           if ($request->file) {
             $path='uploads/'.$google->user_id.'/';
             $fileName = 'service-account-credentials.'.$request->file->extension();
             $request->file->move($path,$fileName);
           }

           return response()->json(['Google Analytics Updated']);
       }

       if ($request->type=='tag-manager') {
             $google_analytics=filter_var($plan['gtm']);
            if($google_analytics == false){
               $msg='This module did not support your subscription.';
               $error['errors']['error']=$msg;
               return response()->json($error,401);
               
            } 

            $validatedData = $request->validate([
                'tag_id' => 'required|max:50',
            ]);

           $tag_manager= Useroption::where('user_id',Auth::id())->where('key','tag_manager')->first();
           if (empty($tag_manager)) {
               $tag_manager = new Useroption;
               $tag_manager->user_id=Auth::id();
               $tag_manager->key="tag_manager";
           }

           $tag_manager->value=$request->tag_id;
           $tag_manager->status=$request->status;
           $tag_manager->save();

           

           return response()->json(['Google Tag Manager Updated']);
       }



       if ($request->type=='whatsapp') {
            $google_analytics=filter_var($plan['whatsapp']);
            if($google_analytics == false){
               $msg='This module did not support your subscription.';
               $error['errors']['error']=$msg;
               return response()->json($error,401);
               
            } 

            $validatedData = $request->validate([
                'number' => 'required|max:20',
                'shop_page_pretext' => 'required|max:50',
                'other_page_pretext' => 'required|max:50',

            ]);

           $google= Useroption::where('user_id',Auth::id())->where('key','whatsapp')->first();
           if (empty($google)) {
               $google = new Useroption;
               $google->user_id=Auth::id();
               $google->key="whatsapp";
           }
           $data['phone_number']=$request->number;
           $data['shop_page_pretext']=$request->shop_page_pretext;
           $data['other_page_pretext']=$request->other_page_pretext;


           $google->value=json_encode($data);
           $google->status=$request->status;
           $google->save();

           return response()->json(['Whatsapp Settings Updated']);
       }
      if ($request->type=='fb_pixel') {
           $google_analytics=filter_var($plan['facebook_pixel']);
            if($google_analytics == false){
               $msg='This module did not support your subscription.';
               $error['errors']['error']=$msg;
               return response()->json($error,401);
               
            } 

          $validatedData = $request->validate([
            'pixel_id' => 'required|max:40',
            

          ]);

        $pixel= Useroption::where('user_id',Auth::id())->where('key','fb_pixel')->first();
        if (empty($pixel)) {
           $pixel = new Useroption;
           $pixel->user_id=Auth::id();
           $pixel->key="fb_pixel";
         }
         


         $pixel->value=$request->pixel_id;
         $pixel->status=$request->status;
         $pixel->save();

         return response()->json(['Facebook Pixel Settings Updated']);
       }


    }

    /**
     * Display the specified resource.
     *
     * @param  string  $param
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
       if ($param=='facebook-pixel') {
            $fb_pixel= Useroption::where('user_id',Auth::id())->where('key','fb_pixel')->first();

           return view('seller.marketing.facebook',compact('fb_pixel'));
        }

        if ($param=='google-analytics') {
            $google= Useroption::where('user_id',Auth::id())->where('key','google-analytics')->first();
            $info=json_decode($google->value ?? '');
            return view('seller.marketing.google',compact('google','info'));
        }

        if ($param=='tag-manager') {
            $tag= Useroption::where('user_id',Auth::id())->where('key','tag_manager')->first();
            $info=json_decode($tag->value ?? '');
            return view('seller.marketing.tag',compact('tag','info'));
        } 

        if ($param=='whatsapp') {
            $whatsapp= Useroption::where('user_id',Auth::id())->where('key','whatsapp')->first();
            $json=json_decode($whatsapp->value ?? '');
            return view('seller.marketing.whatsapp',compact('whatsapp','json'));
        }

        abort(404);
    }

}
