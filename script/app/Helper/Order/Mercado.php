<?php 

namespace App\Helper\Order;
use Illuminate\Http\Request;
use Auth;
use Omnipay\Omnipay;
use Session;
use Illuminate\Support\Facades\Http;
use Redirect;
use Illuminate\Http\RedirectResponse;
use App\Order;
use App\Getway;
use MercadoPago;
use Carbon\Carbon;
use Route;
class Mercado
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
       return url('/payment/mercado');
    }

	public static function make_payment($array)
	{
		
		$user_id= domain_info('user_id');
        $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
        $info=json_decode($data->content);
        
        $data['access_token']=$info->access_token;
        $data['public_key']=$info->public_key;

        if($info->env == 'production'){
            
            $test_mode=false;
        }
        else{
          
            $test_mode=true;
        }

		$phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        

		try {
            //Payment
            MercadoPago\SDK::setAccessToken($data['access_token']);
            $payment = new MercadoPago\Payment();
            $preference = new MercadoPago\Preference();
            $payer = new MercadoPago\Payer();
            $payer->name = $name;
            $payer->email = $email;
            $payer->date_created = Carbon::now();

           
             
            $preference->back_urls = array(
                "success" => Mercado::fallback(),
                "failure" => Mercado::fallback(),
                "pending" => Mercado::fallback(),
            );

            $preference->auto_return = "approved";

            // Create a preference item
            $item = new MercadoPago\Item();
            $item->title = $billName;
            $item->quantity = 1;
            $item->unit_price = str_replace(',', '', number_format($amount,3));
            $preference->items = array($item);
            $preference->payer = $payer;
            $preference->save();


            $data['preference_id'] = $preference->id;
           
           
            
            $redirectUrl = $test_mode == true  ? $preference->sandbox_init_point : $preference->init_point;
            Session::put('mercadopago_credentials', $data);
            return redirect($redirectUrl);

        } catch (\Throwable $th) {
            Mercado::redirect_if_payment_faild();
        }
		
	}


	public function status()
	{
		
		 if (!Session::has('mercadopago_credentials')) {
            return abort(404);
        }
        $response = Request()->all();
        
        $info = Session::get('mercadopago_credentials');
		
		if ($response['status'] == 'approved' || $response['status'] == 'pending') {
            $data['payment_id'] = $response['payment_id'];
            $data['payment_method'] = "mercadopago";
          
           
           
           
            $data['payment_status'] = $response['status'] == 'pending' ? 2 : 1;


			
			$order_info= Session::get('customer_order_info');
			$data['ref_id'] =$order_info['ref_id'];
			$data['getway_id']=$order_info['getway_id'];
			$data['amount'] =$order_info['amount'];
			$data['billName']=$order_info['billName'];
			Session::put('customer_payment_info', $data);
			Session::forget('customer_order_info');
			Session::forget('order_info');
			Session::forget('mercadopago_credentials');
			return redirect(Toyyibpay::redirect_if_payment_success());
		}
		else{
			$order_info= Session::get('customer_order_info');
            Order::destroy($order_info['ref_id']);
            Session::forget('customer_order_info');
            Session::forget('mercadopago_credentials');
			return redirect(Toyyibpay::redirect_if_payment_faild());
		}

	}

    public function __construct()
    {
        abort_if(!Route::has('admin.plan.index'),404);
    }	

}	
