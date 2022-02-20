<?php 
namespace App\Helper\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;
use App\Getway;
use App\Order;
use Route;
class Instamojo 
{
	
     public static function redirect_if_payment_success()
     {
        return url('/payment/payment-success');
     }

    public static function redirect_if_payment_faild()
    {
     return url('/payment/payment-fail');  
    }

    public static function fallback()
    {
     return url('/payment/instamojo'); 
    }

    public static function make_payment($array)
    {
        $user_id= domain_info('user_id');
        $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
        $info=json_decode($data->content);
        $data['private_api_key']=$info->private_api_key;
        $data['private_auth_token']=$info->private_auth_token;
       
        if($info->env == 'production'){
            $data['env']=false;
            $test_mode=false;
        }
        else{
            $data['env']=true;
            $test_mode=true;
        }


        if ($test_mode == true) {
            $url='https://test.instamojo.com/api/1.1/payment-requests/';
        }
        else{
            $url='https://www.instamojo.com/api/1.1/payment-requests/';
        }
       

        $phone=$array['phone'];
        $email=$array['email'];
        $amount=round($array['amount']);
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
      
      
            $params=[
                'purpose' => $billName,
                'amount' => $amount,
                'phone' => $phone,
                'buyer_name' => $name,
                'redirect_url' => Instamojo::fallback(),
                'send_email' => true,
                'send_sms' => true,
                'email' => $email,
                'allow_repeated_payments' => false
            ];
         $response=Http::asForm()->withHeaders([
                'X-Api-Key' => $info->private_api_key,
                'X-Auth-Token' => $info->private_auth_token
            ])->post($url,$params);

        if(isset($response['payment_request'])) {
            $url= $response['payment_request']['longurl'];
            return redirect($url);
        }
       else{
            $order_info= Session::get('customer_order_info');
            Order::destroy($order_info['ref_id']);
            Session::forget('customer_order_info');
            return redirect(Instamojo::redirect_if_payment_faild());
        }
        
    }


    public function status()
    {
        $response=Request()->all();
        $payment_id=$response['payment_id'];
        
        if ($response['payment_status']=='Credit') {
             $data['payment_id'] = $payment_id;
             $data['payment_method'] = "instamojo";
             $order_info= Session::get('customer_order_info');
             $data['ref_id'] =$order_info['ref_id'];
             $data['getway_id']=$order_info['getway_id'];
             $data['amount'] =$order_info['amount'];
             $data['billName']=$order_info['billName'];
             Session::put('customer_payment_info', $data); 
             Session::forget('customer_order_info');
            
             Session::forget('order_info');
             return redirect(Instamojo::redirect_if_payment_success());
        }      
        else{
            $order_info= Session::get('customer_order_info');
            Order::destroy($order_info['ref_id']);
            Session::forget('customer_order_info');
            return redirect(Instamojo::redirect_if_payment_faild());
        }
    }

    public function __construct()
    {
        abort_if(!Route::has('admin.plan.index'),404);
    }
}