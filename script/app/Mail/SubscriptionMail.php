<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionMail extends Mailable
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
        $info=$this->data['info'];
        $comment=$this->data['comment'];
             
        
        return $this->from(env('MAIL_TO'))
                    ->subject('['.strtoupper(env('APP_NAME')).']'.' - Subscription')
                    ->view('email.subscription_invoice',compact('info','comment'));
    }
}
