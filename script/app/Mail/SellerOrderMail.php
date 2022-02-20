<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        $order_url=$data['order_url'];
        $order_no=$data['order_no'];
        $base_url=$data['base_url'];
        $site_name=$data['site_name'];
                     
        return $this->from(env('MAIL_NOREPLY'))
                    ->subject('You Got A New Order '.$order_no)
                    ->view('email.seller_order_receive',compact('order_url','order_no','base_url','site_name'));
    }
}
