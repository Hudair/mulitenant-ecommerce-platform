<?php 

namespace App\Helper\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Omnipay\Omnipay;
use Session;
use App\Category;
class Stripe
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

    public static function make_payment($array)
    {

        $phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        $stripeToken=$array['stripeToken'];
        $currency=$array['currency'];
        $getway_id=$array['getway_id'];

        $info=Category::where('type','payment_getway')->with('credentials')->findorFail($getway_id);
        $credentials=json_decode($info->credentials->content ?? '');

        if ($stripeToken) {
  
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey($credentials->secret_key);
          
            $token = $stripeToken;
          
            $response = $gateway->purchase([
                'amount' => $amount,
                'currency' => strtoupper($credentials->currency),
                "email"=>$email,
                'token' => $token,
            ])->send();
          
            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData(); 
                $data['payment_id'] = $arr_payment_data['id'];
                $data['payment_method'] = "stripe";
                $order_info= Session::get('order_info');
                $data['ref_id'] =$order_info['ref_id'];
                $data['getway_id']=$order_info['getway_id'];
                $data['amount'] =$order_info['amount'];  
                Session::forget('order_info');
                Session::put('payment_info', $data);
                return redirect(Stripe::redirect_if_payment_success());
            } else {
               return redirect(Stripe::redirect_if_payment_faild());
            }
        }      
        
    }
     public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    } 
}