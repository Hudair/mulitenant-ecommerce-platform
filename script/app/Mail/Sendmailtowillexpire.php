<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendmailtowillexpire extends Mailable
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
        $company_info=$data['company_info'];
        return $this->from(env('MAIL_TO'))
                    ->subject('Your Subscription Plan Will Expire Soon')
                    ->view('email.SendMailToWillExpirePlanWithInDay',compact('data','company_info'));
    }
}
