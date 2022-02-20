<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;
use App\Models\User;
use Auth;
use Route;
use App\Subscriber;
class PlanController extends Controller
{
    protected $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       if (!Auth()->user()->can('plan.list')) {
           abort(401);
       }
       $posts=Plan::withCount('active_users')->latest()->get();
       return view('admin.plan.index',compact('posts'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (!Auth()->user()->can('plan.create')) {
           abort(401);
       }
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $plan_data['product_limit']=$request->product_limit;
        $plan_data['customer_limit']=$request->customer_limit;
        $plan_data['storage']=$request->storage;
        $plan_data['custom_domain']=$request->custom_domain;
        $plan_data['inventory']=$request->inventory;
        $plan_data['pos']=$request->pos;
        $plan_data['customer_panel']=$request->customer_panel;
        $plan_data['pwa']=$request->pwa;
        $plan_data['whatsapp']=$request->whatsapp;
        $plan_data['live_support']=$request->live_support;
        $plan_data['qr_code']=$request->qr_code;
        $plan_data['facebook_pixel']=$request->facebook_pixel;
        $plan_data['custom_css']=$request->custom_css;
        $plan_data['custom_js']=$request->custom_js;
        $plan_data['gtm']=$request->gtm;
        $plan_data['location_limit']=$request->location_limit;
        $plan_data['category_limit']=$request->category_limit;
        $plan_data['brand_limit']=$request->brand_limit;
        $plan_data['variation_limit']=$request->variation_limit;
        $plan_data['google_analytics']=$request->google_analytics;
        

        $plan=new Plan;
        $plan->name=$request->name;
        $plan->description=$request->description;
        $plan->price=$request->price;
        $plan->days=$request->days;
        $plan->data=json_encode($plan_data);
        $plan->status=$request->status; 
        $plan->featured=$request->featured;
        $plan->is_default=0;
        $plan->save();

        return response()->json(['Plan Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth()->user()->can('plan.show')) {
           abort(401);
        }
        $this->id=$id;
       
        $posts=User::where('role_id',3)->whereHas('user_plan',function($q){
            return $q->where('plan_id',$this->id);
        })->with('user_domain','user_plan')->latest()->paginate(40);
        return view('admin.plan.show',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth()->user()->can('plan.edit')) {
           abort(401);
        }
        $info=Plan::find($id);
        $plan_info=json_decode($info->data);
        return view('admin.plan.edit',compact('info','plan_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan_data['product_limit']=$request->product_limit;
        $plan_data['customer_limit']=$request->customer_limit;
        $plan_data['storage']=$request->storage;
        $plan_data['custom_domain']=$request->custom_domain;
        $plan_data['inventory']=$request->inventory;
        $plan_data['pos']=$request->pos;
        $plan_data['customer_panel']=$request->customer_panel;
        $plan_data['pwa']=$request->pwa;
        $plan_data['whatsapp']=$request->whatsapp;
        $plan_data['live_support']=$request->live_support;
        $plan_data['qr_code']=$request->qr_code;
        $plan_data['facebook_pixel']=$request->facebook_pixel;
        $plan_data['custom_css']=$request->custom_css;
        $plan_data['custom_js']=$request->custom_js;
        $plan_data['gtm']=$request->gtm;
        $plan_data['location_limit']=$request->location_limit;
        $plan_data['category_limit']=$request->category_limit;
        $plan_data['brand_limit']=$request->brand_limit;
        $plan_data['variation_limit']=$request->variation_limit;
        $plan_data['google_analytics']=$request->google_analytics;


        $plan=Plan::find($id);
        $plan->name=$request->name;
        $plan->description=$request->description;
        $plan->price=$request->price;
        $plan->days=$request->days;
        $plan->data=json_encode($plan_data);
        $plan->status=$request->status; 
        $plan->featured=$request->featured;
        $plan->is_default=0;
        $plan->save();

        return response()->json(['Plan Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!empty($request->type)) {
         if ($request->type=='delete') {
             foreach ($request->ids as $row) {
                Plan::destroy($row);
            }
        }
        
       }
        return response()->json(['Category Deleted']);
    }

    public function __construct()
    {
        abort_if(!Route::has('admin.plan.index'),404);
    }
}
