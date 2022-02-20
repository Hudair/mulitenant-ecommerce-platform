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
class Toyyibpay
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
       return url('/payment/toyyibpay');
    }

	public static function make_payment($array)
	{
		$user_id= domain_info('user_id');
        $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
        $info=json_decode($data->content);
        
        $data['user_secretkey']=$info->user_secretkey;
        $data['category_code']=$info->category_code;

        if($info->env == 'production'){
            $data['env']=false;
            $test_mode=false;
        }
        else{
            $data['env']=true;
            $test_mode=true;
        }

		$phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        

		if ($test_mode == false) {
			$url='https://toyyibpay.com/';
		}
		else{
			$url='https://dev.toyyibpay.com/';
		}

		
		$data = array(
			'userSecretKey'=>$info->user_secretkey,
			'categoryCode'=>$info->category_code,
			'billName'=>$billName,
			'billDescription'=>"Thank you for order",
			'billPriceSetting'=>1,
			'billPayorInfo'=>1,
			'billAmount'=>$amount*100,
			'billReturnUrl'=>Toyyibpay::fallback(),
			'billCallbackUrl'=>Toyyibpay::fallback(),
			'billExternalReferenceNo' => $ref_id,
			'billTo'=>$name,
			'billEmail'=>$email,
			'billPhone'=>$phone,
			'billSplitPayment'=>0,
			'billSplitPaymentArgs'=>'',
			'billPaymentChannel'=>'2',
			'billDisplayMerchant'=>1,
			'billContentEmail'=>"",
			'billChargeToCustomer'=>2
		);  
		 $f_url= $url.'index.php/api/createBill';
		
		$response= Http::asForm()->post($f_url,$data);
		$billcode=$response[0]['BillCode'];
		$url=$url.$billcode;
		return redirect($url);
		
	}


	public function status()
	{
		$response=Request()->all();
		$status=$response['status_id'];
		$payment_id=$response['billcode'];

		
		if ($status==1) {
			$data['payment_id'] = $payment_id;
			$data['payment_method'] = "toyyibpay";
			$order_info= Session::get('customer_order_info');
			$data['ref_id'] =$order_info['ref_id'];
			$data['getway_id']=$order_info['getway_id'];
			$data['amount'] =$order_info['amount'];
			$data['billName']=$order_info['billName'];
			 Session::put('customer_payment_info', $data);
			Session::forget('customer_order_info');
			Session::forget('order_info');
			return redirect(Toyyibpay::redirect_if_payment_success());
		}
		else{
			$order_info= Session::get('customer_order_info');
            Order::destroy($order_info['ref_id']);
            Session::forget('customer_order_info');
			return redirect(Toyyibpay::redirect_if_payment_faild());
		}

	}

	public static  function Toyi($param){
		return \Crypt::decryptString($param);
		
	}
	 public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }	

}	
