<?php 

namespace App\Helper\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Omnipay\Omnipay;
use Session;
use App\Order;
use App\Getway;
class Paypal
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
       return url('/payment/paypal'); 
    }

    public static function make_payment($array)
    {   
        
        $user_id= domain_info('user_id');
        $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
        $info=json_decode($data->content);
        $data['currency']=$info->currency;
        $data['ClientID']=$info->ClientID;
        $data['ClientSecret']=$info->ClientSecret;
        if($info->env == 'production'){
            $data['env']=false;
            $test_mode=false;
        }
        else{
            $data['env']=true;
            $test_mode=true;
        }

        if(Session::has('paypal_credentials')){
            Session::forget('paypal_credentials');
        }
        $credentials=Session::put('paypal_credentials',$data);
       
        $phone=$array['phone'];
        $email=$array['email'];
        $amount=round($array['amount']);
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        $currency=$info->currency;
       
                
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($info->ClientID);
        $gateway->setSecret($info->ClientSecret);
        $gateway->setTestMode($test_mode); 

        if ($test_mode == true) {
           $total_amount=$amount/100;
        }
        else{
            $total_amount=$amount;
        }

        $response = $gateway->purchase(array(
            'amount' => $total_amount,
            'currency' => strtoupper($currency),
            'returnUrl' => Paypal::fallback(),
            'cancelUrl' => Paypal::redirect_if_payment_faild(),
        ))->send();
        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            Order::destroy($ref_id);
            return redirect(Paypal::redirect_if_payment_faild());
        }
    }

    public function status(Request $request)
    {
       
        if(Session::has('paypal_credentials')){
            $credentials=Session::get('paypal_credentials');
        }
        else{
            $user_id= domain_info('user_id');
            $order_info= Session::get('customer_order_info');
            $getway_id=$order_info['getway_id'];
           
           
            $data=Getway::where('user_id',$user_id)->where('category_id',$getway_id)->first();
            $info=json_decode($data->content);
            $credentials['currency']=$info->currency;
            $credentials['ClientID']=$info->ClientID;
            $credentials['ClientSecret']=$info->ClientSecret;
            if($info->env == 'production'){
                $credentials['env']=false;
                $test_mode=false;
            }
            else{
                $credentials['env']=true;
                $test_mode=true;
            }
        }
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($credentials['ClientID']);
        $gateway->setSecret($credentials['ClientSecret']);
        $gateway->setTestMode($credentials['env']); 

        $request= $request->all();

        $transaction = $gateway->completePurchase(array(
            'payer_id'             => $request['PayerID'],
            'transactionReference' => $request['paymentId'],
        ));
        $response = $transaction->send();
        if ($response->isSuccessful()) {
            $arr_body = $response->getData();
            $data['payment_id'] = $arr_body['id'];
            $data['payment_method'] = "paypal";
            $order_info= Session::get('customer_order_info');
            $data['ref_id'] =$order_info['ref_id'];
            $data['getway_id']=$order_info['getway_id'];
            $data['amount'] =$order_info['amount'];
            $data['billName']=$order_info['billName'];
            Session::put('customer_payment_info', $data);
            Session::forget('customer_order_info');
            Session::forget('paypal_credentials');
            return redirect(Paypal::redirect_if_payment_success());
        }
        else{
            $order_info= Session::get('customer_order_info');
           
            Order::destroy($order_info['ref_id']);
            Session::forget('paypal_credentials');
            Session::forget('customer_order_info');
           return redirect(Paypal::redirect_if_payment_faild());
        }
    }

     public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }

}