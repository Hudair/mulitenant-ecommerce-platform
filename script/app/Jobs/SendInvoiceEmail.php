<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CustomerOrderMail;
use App\Mail\SubscriptionMail;
use App\Mail\Sendmailtowillexpire;
use App\Mail\OrderMail;
use App\Mail\Planexpired;
use App\Mail\Contactmail;
use Mail;

class SendInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data=$this->data;
        if (isset($data['to_vendor'])) {
            $info=$data['info'];
           Mail::to($info->user->email)->send(new SubscriptionMail($data));
        }
        elseif (isset($data['to_admin'])) {
            $info=$data['info'];
            $mail_to=$data['to_admin'];
            Mail::to($mail_to)->send(new OrderMail($data));
        }
        elseif (isset($data['to_will_expire_user'])) {
            $mail_to=$data['to_will_expire_user'];
            Mail::to($mail_to)->send(new Sendmailtowillexpire($data));
        }
        elseif (isset($data['expired_user'])) {
            $mail_to=$data['expired_user'];
            Mail::to($mail_to)->send(new Planexpired($data));
        }
        elseif (isset($data['to_subscriber'])) {
            $mail_to=$data['to_subscriber'];
            Mail::to($mail_to)->send(new Contactmail($data));
        }
        else{
           Mail::to($data['customer_email'])->send(new CustomerOrderMail($data)); 
        }
        
    }
}
