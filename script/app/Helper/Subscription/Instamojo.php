<?php 

namespace App\Helper\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;
use App\Category;
class Instamojo 
{
	
     public static function redirect_if_payment_success()
     {
        if (url('/') == env('APP_URL')) {
            return url('/merchant/payment-success');
        }
        else{
            return route('seller.payment.success');
        }

    }

    public static function redirect_if_payment_faild()
    {
        if (url('/') == env('APP_URL')) {
            return url('/merchant/payment-fail');
        }
        else{
            return route('seller.payment.fail');
        }
    }

    public static function fallback()
    {
        if (url('/') == env('APP_URL')) {
            return url('/merchant/instamojo');
        }
        else{
            return route('seller.instamojo.fallback');
        }
    }

    public static function make_payment($array)
    {
        if (env('APP_DEBUG') == true) {
            $url='https://test.instamojo.com/api/1.1/payment-requests/';
        }
        else{
            $url='https://www.instamojo.com/api/1.1/payment-requests/';
        }
       

        $phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        $currency=$array['currency'];

        $info=Category::where('type','payment_getway')->with('credentials')->findorFail($getway_id);
        $credentials=json_decode($info->credentials->content ?? '');

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
            'X-Api-Key' => $credentials->x_api_Key,
            'X-Auth-Token' => $credentials->x_api_token
        ])->post($url,$params);

       
        $url= $response['payment_request']['longurl'];
        return redirect($url);
    }


    public function status()
    {
        $response=Request()->all();
        $payment_id=$response['payment_id'];
        
        if ($response['payment_status']=='Credit') {
             $data['payment_id'] = $payment_id;
             $data['payment_method'] = "instamojo";
             $order_info= Session::get('order_info');
             $data['ref_id'] =$order_info['ref_id'];
             $data['getway_id']=$order_info['getway_id'];
             $data['amount'] =$order_info['amount'];  

             Session::forget('order_info');
             Session::put('payment_info', $data);
             return redirect(Instamojo::redirect_if_payment_success());
        }      
        else{
            return redirect(Instamojo::redirect_if_payment_faild());
        }
    }
     public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }
}