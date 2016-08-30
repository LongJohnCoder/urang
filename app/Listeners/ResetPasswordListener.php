<?php

namespace App\Listeners;

use App\Events\ResetPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class ResetPasswordListener
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
     * @param  ResetPassword  $event
     * @return void
     */
    public function handle(ResetPassword $event)
    {
        //dd($event->req);
        Mail::send('email.reset-password', array('email'=>$event->req->email, 'id' => $event->req->id), 
        function($message) use ($event)
        {
            $message->from("lisa@u-rang.com", "Admin U-rang");
            $message->to($event->req->email)->subject('Reset Password U-rang');
        });
    }
}
