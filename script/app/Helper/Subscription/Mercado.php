<?php

namespace App\Helper\Subscription;

use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use Http;
use Str;
use MercadoPago;
use App\Category;
class Mercado
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
        return url('/merchant/payment/mercado');
      }
      else{
        return url('seller/payment_with_mercado');
      }
      
    }

    public static function make_payment($array)
    {
        $phone=$array['phone'];
        $email=$array['email'];
        $total_amount=str_replace(',','',number_format($array['amount'],3));
        $ref_id=$array['ref_id'];
        $getway_id=$array['getway_id'];
        $name=$array['name'];
        $billName=$array['billName'];
        

        $info=Category::where('type','payment_getway')->with('credentials')->findorFail($getway_id);
        $credentials=json_decode($info->credentials->content ?? '');
        $data['public_key']=$credentials->public_key;
        $data['access_token']=$credentials->access_token;

       try {
            //Payment
            MercadoPago\SDK::setAccessToken($credentials->access_token);
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
            $item->unit_price = $total_amount;
            $preference->items = array($item);
            $preference->payer = $payer;
            $preference->save();


            $data['preference_id'] = $preference->id;
           
           
            
            $redirectUrl = env('APP_DEBUG') == true  ? $preference->sandbox_init_point : $preference->init_point;
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
            

           
            Session::forget('mercadopago_credentials');
            Session::put('payment_info', $data);

            
            $order_info= Session::get('order_info');
            $data['ref_id'] =$order_info['ref_id'];
            $data['amount'] =$order_info['amount'];
            $data['getway_id']=$order_info['getway_id'];
            Session::forget('order_info');
            Session::put('payment_info', $data);

            return redirect(Mollie::redirect_if_payment_success());
           
        }else{
            Session::forget('mercadopago_credentials');
            return redirect(Mercado::redirect_if_payment_faild());
        }
    }
     public function __construct()
    {
        abort_if(!\Route::has('admin.plan.index'),404);
    }

}
