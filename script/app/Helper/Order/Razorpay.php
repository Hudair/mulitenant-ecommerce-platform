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
use Razorpay\Api\Api;
class Razorpay
{
	protected static $payment_id;

	 public static function redirect_if_payment_success()
     {
        return url('/payment/payment-success');
     }

    public static function redirect_if_payment_faild()
    {
     return url('/payment/payment-fail');  
    }

    public function view(){
        if(Session::has('razorpay_payment') && Session::get('customer_order_info')){
            $array=Session::get('customer_order_info');
            $amount=$array['amount'];
            $user_id= domain_info('user_id');
            $data=Getway::where('user_id',$user_id)->where('category_id',$array['getway_id'])->first();
            $info=json_decode($data->content);

            $credentials['key_id']=$info->key_id;
            $credentials['key_secret']=$info->key_secret;
            $credentials['currency']=$info->currency;

            if(Session::has('razorpay_credentials')){
                Session::forget('razorpay_credentials');
            }
            Session::put('razorpay_credentials',$credentials);
            
            $Info=Razorpay::make_payment();

          return view(base_view().'.payment.razorpay',compact('amount','Info'));
        }
        abort(404);
    }

   




    public static function make_payment()
    {
       $array=Session::get('customer_order_info');
       $amount=$array['amount'];

        $phone=$array['phone'];
        $email=$array['email'];
        $amount=$array['amount'];
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
       
        $razorpay_credentials=Session::get('razorpay_credentials');


        $api = new Api($razorpay_credentials['key_id'], $razorpay_credentials['key_secret']);
        $referance_id=$ref_id;
        $order = $api->order->create(array(
            'receipt' => $referance_id,
            'amount' => $amount*100,
            'currency' => $razorpay_credentials['currency'],
        )
        );

         // Return response on payment page
        $response = [
            'orderId' => $order['id'],
            'razorpayId' => $razorpay_credentials['key_id'],
            'amount' => $amount*100,
            'name' => $name,
            'currency' => $razorpay_credentials['currency'],
            'email' => $email,
            'contactNumber' => $phone,
            'address' => "",
            'description' => $billName,
        ];

        // Let's checkout payment page is it working
        return $response;
    }


    public function status(Request $request)
    {


      if(Session::has('razorpay_payment') && Session::has('customer_order_info') && Session::has('razorpay_credentials')){
        
       
    // Now verify the signature is correct . We create the private function for verify the signature
        $signatureStatus = Razorpay::SignatureVerify(
            $request->all()['rzp_signature'],
            $request->all()['rzp_paymentid'],
            $request->all()['rzp_orderid']
        );

      // If Signature status is true We will save the payment response in our database
      // In this tutorial we send the response to Success page if payment successfully made
        if($signatureStatus == true)
        {
            $order_info= Session::get('customer_order_info');
      
            //for success
            $data['payment_id'] = Razorpay::$payment_id;
            $data['payment_method'] = "razorpay";

            $data['ref_id'] =$order_info['ref_id'];
            $data['getway_id']=$order_info['getway_id'];
            $data['amount'] =$order_info['amount'];
            $data['billName']=$order_info['billName'];
            Session::put('customer_payment_info', $data); 
            Session::forget('customer_order_info');
            Session::forget('order_info');
            Session::forget('razorpay_payment');
            Session::forget('razorpay_credentials');
            return redirect(Razorpay::redirect_if_payment_success());
        }
        else{
            $order_info= Session::get('customer_order_info');

            Order::destroy($order_info['ref_id']);
            Session::forget('customer_order_info');
            Session::forget('order_info');
            Session::forget('razorpay_payment');
            Session::forget('razorpay_credentials');
            return redirect(Razorpay::redirect_if_payment_faild());
        }

      }
    }

    // In this function we return boolean if signature is correct
    private static function SignatureVerify($_signature,$_paymentId,$_orderId)
    {
        try
        {
             $razorpay_credentials=Session::get('razorpay_credentials');
        // Create an object of razorpay class
            $api = new Api($razorpay_credentials['key_id'], $razorpay_credentials['key_secret']);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            Razorpay::$payment_id=$_paymentId;
            return true;
        }
        catch(\Exception $e)
        {
        // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }

     public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }   


}    