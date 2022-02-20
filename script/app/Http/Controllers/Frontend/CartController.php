<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Cart;
use App\Category;
use App\Term;
use Carbon\Carbon;
class CartController extends Controller
{
    
    public function add_to_cart(Request $request,$id)
    {
    	$id=request()->route()->parameter('id');
    	$user_id=domain_info('user_id');
    	
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);
       if($request->option != null){
        $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
            return $q->whereIn('id',$option);
            }
            else{
                return $q;
            }
            });
       }
       if($request->variation){
        $term=$term->with('attributes',function($q) use ($variation){
            if(count($variation) > 0){
             return $q->whereIn('id',$variation);
            }
            else{
                return $q;
            }
         
        });
       }
       $term= $term->first();
       if(!empty($term)){
           $price=$term->price->price;
           if($request->option != null){
            foreach($term->termoption ?? [] as $row){
                if($row->amount_type == 1){
                 $price= $price+$row->amount;
                }
                else{
                 $percent= $price * $row->amount / 100;
                 $price= $price+$percent;
                }
            }
            $options=$term->termoption;
           }
           else{
            $options= [];
           }

           if($request->variation != null){
            $attributes=$term->attributes ?? [];
           }
           else{
            $attributes= [];
           }
           $qty=$request->qty ?? 1;

           $price=$price;
                   
           Cart::add($term->id,$term->title, $qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
          
       }
        $data['count']=Cart::count();
    	$data['total']=Cart::total();
    	$data['subtotal']=Cart::subtotal();
    	$data['cart_add']=Cart::content();

    	return response()->json($data);
    }


    public function add_to_wishlist(Request $request,$id){
        $id=request()->route()->parameter('id');
        $user_id=domain_info('user_id');
        
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('id',$id);
        if($request->option != null){
         $term=$term->with('termoption',function($q) use ($option){
             if(count($option) > 0){
             return $q->whereIn('id',$option);
             }
             else{
                 return $q;
             }
             });
        }
        if($request->variation){
         $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
              return $q->whereIn('id',$variation);
             }
             else{
                 return $q;
             }
          
         });
        }
        $term= $term->first();
        if(!empty($term)){
            $price=$term->price->price;
            if($request->option != null){
             foreach($term->termoption ?? [] as $row){
                 if($row->amount_type == 1){
                  $price= $price+$row->amount;
                 }
                 else{
                  $percent= $price * $row->amount / 100;
                  $price= $price+$percent;
                 }
             }
             $options=$term->termoption;
            }
            else{
             $options= [];
            }
 
            if($request->variation != null){
             $attributes=$term->attributes ?? [];
            }
            else{
             $attributes= [];
            }
            $qty=$request->qty ?? 1;
 
            $price=$price*$qty;
                    
            Cart::instance('wishlist')->add($term->id,$term->title, $qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        return Cart::instance('wishlist')->count();
    }

    public function wishlist_remove(){
          $id=request()->route()->parameter('id');
          Cart::instance('wishlist')->remove($id);
          return back();
    }

    public function cart_clear()
    {
        Cart::destroy();
        return back();
    }

    public function cart_add(Request $request)
    {
      
        $id=$request->id;
        $user_id=domain_info('user_id');
        $option=$request->option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($request->option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if($request->variation != null){
            
            $variation=[];
            foreach($request->variation as $key => $row){
                array_push($variation,$row);
            }

            
            $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
                 return $q->whereIn('variation_id',$variation);
             }
             else{
                   return $q;
             }
             
            });
           
        }
         $term= $term->first();
       
        if(!empty($term)){
            $price=$term->price->price;

            if($request->option != null){
             foreach($term->termoption ?? [] as $row){
                 if($row->amount_type == 1){
                  $price= $price+$row->amount;
                 }
                 else{
                  $percent= $price * $row->amount / 100;
                  $price= $price+$percent;
                 }
             }
             $options=$term->termoption;
            }
            else{
             $options= [];
            }
 
            if($request->variation != null){
             $attributes=$term->attributes ?? [];
             
            }
            else{
             $attributes= [];
            }
           
           
            $price=$price;
            // dd($price);       
            Cart::add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }
        
        
        $data['count']=Cart::count();
        $data['total']=Cart::total();
        $data['subtotal']=Cart::subtotal();
        $data['cart_add']=Cart::content();

        return response()->json($data);
    }



    public function remove_cart(Request $request){
        Cart::remove($request->id);
        $data['count']=Cart::count();
        $data['total']=Cart::total();
        $data['subtotal']=Cart::subtotal();
        $data['cart_add']=Cart::content();
        return response()->json($data);

    }

    public function cart_remove($id){
        $id=request()->route()->parameter('id');
        Cart::remove($id);
        return back();

    }

    public function apply_coupon(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required|max:50',
         ]);
        $user_id=domain_info('user_id');
        $code=Category::where('user_id',$user_id)->where('type','coupon')->where('name',$request->code)->first();
        if (empty($code)) {
           $error['errors']['error']='Coupon Code Not Found.';
           return response()->json($error,404);
        }
        $mydate= Carbon::now()->toDateString();
        if ($code->slug >= $mydate) {
            Cart::setGlobalDiscount($code->featured);

            return response()->json(['Coupon Applied']);
        }

        $error['errors']['error']='Sorry, this coupon is expired';
        return response()->json($error,401);



    }

    public function express(Request $request){
       
        $id=$request->id;
        $user_id=domain_info('user_id');
        $option=$request->option ?? [];
        $term=Term::where('user_id',$user_id)->with('price','preview')->where('status',1)->where('id',$id);
        if($request->option != null){
            $term=$term->with('termoption',function($q) use ($option){
            if(count($option) > 0){
                return $q->whereIn('id',$option);
                }
                else{
                    return $q;
                }
            });
        }
        if($request->variation != null){
            
            $variation=[];
            foreach($request->variation as $key => $row){
                array_push($variation,$row);
            }

            
            $term=$term->with('attributes',function($q) use ($variation){
             if(count($variation) > 0){
                 return $q->whereIn('variation_id',$variation);
             }
             else{
                   return $q;
             }
             
            });
           
        }
         $term= $term->first();
       
        if(!empty($term)){
            $price=$term->price->price;

            if($request->option != null){
             foreach($term->termoption ?? [] as $row){
                 if($row->amount_type == 1){
                  $price= $price+$row->amount;
                 }
                 else{
                  $percent= $price * $row->amount / 100;
                  $price= $price+$percent;
                 }
             }
             $options=$term->termoption;
            }
            else{
             $options= [];
            }
 
            if($request->variation != null){
             $attributes=$term->attributes ?? [];
             
            }
            else{
             $attributes= [];
            }
           
           
            $price=$price;
            // dd($price);       
             Cart::add($term->id,$term->title, $request->qty,$price,0,['attribute' => $attributes,'options'=>$options,'preview' => $term->preview->media->url ?? asset('uploads/default.png')]);
           
        }

       
       return redirect('/checkout');
    }

}
