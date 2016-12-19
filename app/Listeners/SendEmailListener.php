<?php

namespace App\Listeners;

use App\Events\SendEmailOnSignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailOnSignUp  $event
     * @return void
     */
    public function handle(SendEmailOnSignUp $event)
    {
        //dd($event->req);
        Mail::send('email.confirmation', array('email'=>$event->req->email, 'password' => $event->req->password, 'name' => $event->req->name, 'address' => isset($event->req->strt_address_1) ? $event->req->strt_address_1 : $event->req->address, 'ph' => $event->req->personal_phone), function($message) use ($event){
            $message->getSwiftMessage()->getHeaders()->addTextHeader('x-mailgun-native-send', 'true');
            $message->from(env('ADMIN_EMAIL'), "Urang");
            $message->to($event->req->email, $event->req->name)->subject('Signup Details');
            });

        Mail::send('email.admin-confirmation', array('email'=>$event->req->email, 'password' => $event->req->password, 'name' => $event->req->name, 'address' => $event->req->strt_address_1, 'ph' => $event->req->personal_phone), function($message) use ($event){
            $message->getSwiftMessage()->getHeaders()->addTextHeader('x-mailgun-native-send', 'true');
            $message->from($event->req->email, $event->req->name);
            $message->to(env('ADMIN_EMAIL'), "Urang")->subject('New User Signup');
            });
    }
}
