<?php 
namespace App\Helper\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Support\Facades\Http;
use App\Getway;
use App\Order;
class Mollie 
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
     return url('/payment/mollie'); 
    }

    public static function make_payment($array){

         $user_id= domain_info('user_id');
        $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
        $info=json_decode($data->content);
        $data['currency']=$info->currency;
        $data['api_key']=$info->api_key;
        

        if(Session::has('mollie_credentials')){
            Session::forget('mollie_credentials');
        }
        $credentials=Session::put('mollie_credentials',$data);

        $phone=$array['phone'];
        $email=$array['email'];
        $total_amount=str_replace(',','',number_format($array['amount'],2));
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        $currency=$info->currency;

        try {
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey($info->api_key);

            $payment = $mollie->payments->create([

                "amount" => [
                    "currency" => $currency,
                    "value" => $total_amount
                ],
                "description" => $billName,
                "redirectUrl" => Mollie::fallback(),

            ]);
            Session::put('pay_id',$payment->id);
            return redirect($payment->getCheckoutUrl()) ;
        }
        catch (\Exception $e) {
            Order::destroy($ref_id);
            Session::forget('customer_order_info');
            Session::forget('mollie_credentials');
            return redirect(Mollie::redirect_if_payment_faild());  
        }
        
    }

    public function status(Request $request){
     
        if(Session::has('pay_id') && Session::has('mollie_credentials')){
              $info=Session::get('mollie_credentials');
             

              $mollie = new \Mollie\Api\MollieApiClient();
              $mollie->setApiKey($info['api_key']);
              $pay_id= Session::get('pay_id');
              $payment = $mollie->payments->get($pay_id);

              if ($payment->isPaid())
              {
                
                $data['payment_id'] = $pay_id;
                $data['payment_method'] = "mollie";
                $order_info= Session::get('customer_order_info');
                $data['ref_id'] =$order_info['ref_id'];
                $data['getway_id']=$order_info['getway_id'];
                $data['amount'] =$order_info['amount'];
                $data['billName']=$order_info['billName'];
                Session::put('customer_payment_info', $data);
                Session::forget('customer_order_info');
               
                Session::forget('mollie_credentials');
                Session::forget('pay_id');
                return redirect(Mollie::redirect_if_payment_success());
              }
              $order_info= Session::get('customer_order_info');

              Order::destroy($order_info['ref_id']);
              Session::forget('customer_order_info');
              Session::forget('mollie_credentials');
              Session::forget('pay_id');
              return redirect(Mollie::redirect_if_payment_faild());  
        }
        abort(401);
        
    }

    public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }


}