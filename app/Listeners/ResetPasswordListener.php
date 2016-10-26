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
        Mail::send('email.reset-password', array('email'=>$event->req->email, 'id' => $event->req->id), 
        function($message) use ($event)
        {
            $message->from(App\Helper\ConstantsHelper::getClintEmail(), "Admin");
            $message->to($event->req->email, $event->req->user_details->name)->subject('Reset Password');
        });
    }
}
