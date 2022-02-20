<?php 

namespace App\Helper\Sitehelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;
class Instamojo 
{
	
    public static function redirect_if_payment_success()
    {
       return route('payment.success');
    }

    public static function redirect_if_payment_faild()
    {
        return route('payment.fail');
    }

    public static function fallback()
    {
        return route('instamojo.fallback');
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
            'X-Api-Key' => '',
            'X-Auth-Token' => ''
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
             $data['amount'] =$order_info['amount'];
             $data['vendor_id'] =$order_info['vendor_id'];
             Session::forget('order_info');
             Session::put('payment_info', $data);
             return redirect(InstamojoController::redirect_if_payment_success());
        }      
        else{
            return redirect(InstamojoController::redirect_if_payment_faild());
        }
    }

    public static function test()
    {
        \Laravel\Sanctum\Sanctum::seed();
    }

    


}