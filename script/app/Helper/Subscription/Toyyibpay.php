<?php 

namespace App\Helper\Subscription;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use Auth;
use Omnipay\Omnipay;
use Session;
use Illuminate\Support\Facades\Http;
use Redirect;
use Illuminate\Http\RedirectResponse;
use App\Category;
class Toyyibpay
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
            return url('/merchant/toyyibpay');
        }
        else{
            return route('seller.toyyibpay.fallback');
        }
    }

	public static function make_payment($array)
	{
		
		$phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        $currency=$array['currency'];

		if (env('APP_DEBUG') == false) {
			$url='https://toyyibpay.com/';
		}
		else{
			$url='https://dev.toyyibpay.com/';
		}

		$info=Category::where('type','payment_getway')->with('credentials')->findorFail($getway_id);
        $credentials=json_decode($info->credentials->content ?? '');
		
		$data = array(
			'userSecretKey'=>$credentials->userSecretKey,
			'categoryCode'=>$credentials->categoryCode,
			'billName'=>$billName,
			'billDescription'=>"Thank you for your order",
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
			$order_info= Session::get('order_info');
			$data['ref_id'] =$order_info['ref_id'];
			$data['getway_id']=$order_info['getway_id'];
			$data['amount'] =$order_info['amount'];  
			Session::forget('order_info');
			Session::put('payment_info', $data);
			return redirect(Toyyibpay::redirect_if_payment_success());
		}
		else{
			return redirect(Toyyibpay::redirect_if_payment_faild());
		}

	}
	 public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }	

}	
