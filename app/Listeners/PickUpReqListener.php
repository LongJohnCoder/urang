<?php

namespace App\Listeners;

use App\Events\PickUpReqEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Coupon;
use App\User;
use App\UserDetails;
use Mail;
class PickUpReqListener
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
     * @param  PickUpReq  $event
     * @return void
     */
    public function handle(PickUpReqEvent $event)
    {
        dd($event->req->identifier);

        $table_data = ''; //detail pickup data
        $subtotal = 0.00;
        $discount = 0.00;
        $emergency_money = 0;
        if ($event->req->identifier == "admin") {
            $user_to_search = User::with('user_details')->find($event->req->user_id);
            if ($user_to_search) {
                //dd($user_to_search);
                $email = $user_to_search->email;
                $user_name = $user_to_search->user_details->name;
                $number = $user_to_search->user_details->personal_ph;
            }
            else
            {
                $email = "lisa@u-rang.com";
                $user_name = "undefined";
                $number = 00000000;
            }
           /* $email = auth()->guard('users')->user()->email; //user email
            $user_name = auth()->guard('users')->user()->user_details->name; //user name
            $number =  auth()->guard('users')->user()->user_details->personal_ph; //phon number*/
        }
        else
        {
            $email = isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email:$event->req->user_email; //user email
            $user_name = isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"$event->req->user_name"; //user name
            $number =  isset(auth()->guard('users')->user()->user_details->personal_ph)?auth()->guard('users')->user()->user_details->personal_ph:$event->req->user_number; //phon number
        }
        //details pick up
        if ($event->req->list_items_json != '') {
            $format_items = json_decode($event->req->list_items_json);
            //dd();
            for($i=0; $i<count($format_items); $i++)
            {
                $table_data .= "<tr><td>".$format_items[$i]->item_name."</td><td>".$format_items[$i]->number_of_item."</td><td> $".$format_items[$i]->item_price."</td></tr>";

                $subtotal +=  $format_items[$i]->number_of_item*$format_items[$i]->item_price;
            }
            if(isset($event->req->isEmergency))
            {
                //$subtotal += 7;
                $emergency_money = 7;
            }
        }
        //fast pickup
        else
        {
            $table_data = '';
        }
        //dd($subtotal);
        $invoice_id = $event->inv_id; //invoice id 
        $date_today = $event->req->pick_up_date; //date
        $coupon = $event->req->coupon; // coupon 
        if ($coupon != null) {
            $discount_percentage = Coupon::where('coupon_code', $coupon)->first();
            //dd($discount_percentage);
            if ($discount_percentage != "" && $discount_percentage->isActive == 1) {
                if(isset($event->req->isEmergency))
                {
                    $discount = ($subtotal+7)*($discount_percentage->discount/100);
                }
                else
                {
                    $discount = $subtotal*($discount_percentage->discount/100);
                }
            }
            else
            {
                $discount = 0.00;
                $coupon = "Not a valid coupon";
            }
        }
        else
        {
            $discount = 0.00;
            $coupon = "No Coupon Applied";
        }
        //dd();
        $some = Mail::send('email.pickupemail', array('username'=>$user_name, 'email' => $email, 'phone_num' => $number, 'invoice_num' => $invoice_id, 'date_today' => $date_today, 'coupon' => $coupon, 'subtotal' => $subtotal, 'discount' => $discount, 'table_data' => $table_data,'emergency_money' => $emergency_money), 
            function($message) use ($event){
                $message->from("lisa@u-rang.com", "Admin");
                if ($event->req->identifier == "admin") {
                    $user_to_search = User::with('user_details')->find($event->req->user_id);
                    if ($user_to_search) {
                        //dd($user_to_search);
                        $email = $user_to_search->email;
                        $user_name = $user_to_search->user_details->name;
                        $number = $user_to_search->user_details->personal_ph;
                    }
                    else
                    {
                        $email = "lisa@u-rang.com";
                        $user_name = "undefined";
                        $number = 00000000;
                    }
                    $message->to($email, $user_name)->subject('Pickuprequest Details U-rang');
                }
                else
                {
                    $message->to(isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email:$event->req->user_email, isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"$event->req->user_name")->subject('Pickuprequest Details U-rang');
                }   
            });
        dd($some);
    }
}
