<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerOrderMail extends Mailable
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
        $order=$data['order'];
        $location=$data['location'];
        $order_content=$data['order_content'];
        $base_url=$data['url'];
        return $this->from($data['admin_email'])
                    ->subject('Order Mail')
                    ->view('email.email_invoice',compact('order','location','order_content','base_url'));
    }
}
