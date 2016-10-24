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
        $flag = Mail::send('email.confirmation', array('email'=>$event->req->email, 'password' => $event->req->password, 'name' => $event->req->name, 'address' => $event->req->address, 'ph' => $event->req->personal_phone), function($message) use ($event){
            $message->getSwiftMessage()->getHeaders()->addTextHeader('x-mailgun-native-send', 'true');
            $message->from("lisa@u-rang.com", "Urang");
            $message->to($event->req->email, $event->req->name)->subject('Signup Details');
            });

            if ($flag) {
                $email = $event->req->name;
                preg_match('#^(\w+\.)?\s*([\'\’\w]+)\s+([\'\’\w]+)\s*(\w+\.?)?$#', $event->req->name, $subscriberName);
                $firstName = $subscriberName[2];
                $lastName = $subscriberName[3];

                /** MailChimp API credentials */
                $apiKey = 'cd02d89596497b4cc0fb86308432d7dc-us11';
                $listID = 'aff6e8384a';

                /** MailChimp API URL */
                $memberID = md5(strtolower($event->req->email));
                $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
                $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

                /** member information */
                $json = json_encode([
                    'email_address' => $email,
                    'status'        => 'subscribed',
                    'merge_fields'  => [
                        'FNAME'     => $firstName,
                        'LNAME'     => $lastName
                    ]
                ]);

                /** send a HTTP POST request with curl */
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
        }
    }
}