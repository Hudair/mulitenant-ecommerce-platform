<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Order;
class ReportController extends Controller
{
    public function index(Request $request)
    {
    	$user_id=Auth::id();
    	if ($request->start) {
    		
    		$start = date("Y-m-d",strtotime($request->start));
    		$end = date("Y-m-d",strtotime($request->end));

    		$total=Order::where('user_id',$user_id)->whereBetween('created_at',[$start,$end])->count();
    		$completed=Order::where('user_id',$user_id)->whereBetween('created_at',[$start,$end])->where('status','completed')->count();
    		$canceled=Order::where('user_id',$user_id)->whereBetween('created_at',[$start,$end])->where('status','canceled')->count();
    		$proccess=Order::where('user_id',$user_id)->whereBetween('created_at',[$start,$end])->where([
    			['status','!=','completed'],
    			['status','!=','canceled'],
    		])->count();


    		$amounts=Order::where([
    			['user_id',$user_id]
    		])->whereBetween('created_at',[$start,$end])->sum('total');
    		$amount_cancel=Order::where([
    			['user_id',$user_id],
    			['status','canceled'],
    			['payment_status',0]
    		])->whereBetween('created_at',[$start,$end])->sum('total');
    		$amount_proccess=Order::where([
    			['user_id',$user_id],
    			['status','!=','completed'],
    			['status','!=','canceled'],
    			
    		])->whereBetween('created_at',[$start,$end])->sum('total');
    		$amount_completed=Order::where([
    			['user_id',$user_id],
    			['status','completed'],
    			['payment_status',1]
    		])->whereBetween('created_at',[$start,$end])->sum('total');



    		$orders=Order::where('user_id',$user_id)->whereBetween('created_at',[$start,$end])->with('customer')->withCount('order_items')->orderBy('id','DESC')->paginate(40);
    	}
    	else{
    		$orders=Order::where([
    			['user_id',$user_id]
    		])->with('customer')->withCount('order_items')->orderBy('id','DESC')->paginate(40);
    		$total=Order::where('user_id',$user_id)->count();
    		$completed=Order::where('user_id',$user_id)->where('status','completed')->count();
    		$canceled=Order::where('user_id',$user_id)->where('status','canceled')->count();
    		$proccess=Order::where('user_id',$user_id)->where([
    			['status','!=','completed'],
    			['status','!=','canceled'],
    		])->count();

    		$amounts=Order::where([
    			['user_id',$user_id]
    		])->sum('total');
    		$amount_cancel=Order::where([
    			['user_id',$user_id],
    			['status','canceled'],
    			['payment_status',0]
    		])->sum('total');
    		$amount_proccess=Order::where([
    			['user_id',$user_id],
    			['status','!=','completed'],
    			['status','!=','canceled'],

    		])->sum('total');
    		$amount_completed=Order::where([
    			['user_id',$user_id],
    			['status','completed'],
    			['payment_status',1]
    		])->sum('total');

    		
    	}

    	$start=$request->start ?? '';
    	$end=$request->end ?? '';
    	return view('seller.report.index',compact('orders','start','end','total','completed','canceled','proccess','amounts','amount_cancel','amount_proccess','amount_completed','request'));
    }
}
