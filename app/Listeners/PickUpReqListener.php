<?php

namespace App\Listeners;

use App\Events\PickUpReqEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Coupon;
use App\User;
use App\UserDetails;
use Mail;
use App\Helper\ConstantsHelper;
use App\refPercentage;
use App\ref;
use App\Helper\SiteHelper;
use App\Pickupreq;
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

        $table_data = ''; //detail pickup data
        $subtotal = 0.00;
        $actutalsubtotal = 0.00;
        $actutaltotal = 0.00;
        $discount = 0.00;
        $refferal_discount=0.00;
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
                $email = \App\Helper\ConstantsHelper::getClintEmail();
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
            $user_name = isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"User name"; //user name
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

            $actutalsubtotal=$subtotal;

            if($event->req->isEmergency == 1 || $event->req->isEmergency == "on")
            {
                $subtotal += 7;
                $emergency_money = 7;
            }

            if ($event->is_eligible_for_sign_up_discount) {
                $subtotal -= $subtotal * 10/100;
                $discount = $subtotal * 10/100;
            }

            $actutaltotal=$subtotal;

        }
        //fast pickup
        else
        {
            $table_data = '';
        }
       // dd($subtotal);
        $invoice_id = $event->inv_id; //invoice id
        $date_today = $event->req->pick_up_date; //date

        $calculate_discount = new SiteHelper();
            //now check this pick up req related to any ref or not
               if ($event->req->identifier == "admin") {
                $check_ref = ref::where('user_id', $event->req->user_id)->where('discount_status', 1)->where('is_expired', 0)->first();
            }
            else
            {

                $getUserId = isset(auth()->guard('users')->user()->id)?auth()->guard('users')->user()->id:$event->req->user_id; 

                $check_ref = ref::where('user_id', $getUserId)->where('discount_status', 1)->where('is_expired', 0)->first();

            }
            //dd($total_price);
            if (count($check_ref)>0) {
                $pick_up_req = new Pickupreq();
                 $pick_up_req->ref_discount  =  1;
                if($check_ref->discount_count>1)
                {
                    $check_ref->discount_count = $check_ref->discount_count-1;
                    $check_ref->is_expired      =  0;
                }
                else
                {
                    $check_ref->is_expired      =  1;
                    $check_ref->discount_count = 0;
                }

               $check_ref->save();

                 $calculateRefPrice=$subtotal;
                if ($calculateRefPrice > 0.0) {
                   
                   $referral_price = $calculate_discount->updateTotalPriceOnRef($subtotal);
                    
                    $refferal_discount = $subtotal - $referral_price;

                    $subtotal=$referral_price;
                }
               
            }

          
         

        $coupon = $event->req->coupon; // coupon
        if ($coupon != null) {
            $discount_percentage = Coupon::where('coupon_code', $coupon)->first();
            //dd($discount_percentage);
            if ($discount_percentage != "" && $discount_percentage->isActive == 1) {
                if($event->req->isEmergency == 1 || $event->req->isEmergency == "on")
                {
                    $discount += ($subtotal)*($discount_percentage->discount/100);
                }
                else
                {
                    $discount += $subtotal*($discount_percentage->discount/100);
                }
            }
            else
            {
                //$discount = 0.00;
                $coupon = "Not a valid coupon";
            }
        }
        else
        {
            $discount = 0.00;
            $coupon = "No Coupon Applied";
        }
       $actutalsubtotal= number_format((float)$actutalsubtotal,2, '.', '');
       $actutaltotal=number_format((float)$actutaltotal,2, '.', '');
        $subtotal=number_format((float)$subtotal + $refferal_discount,2, '.', '');


        $some = Mail::send('email.pickupemail', array('username'=>$user_name, 'email' => $email, 'phone_num' => $number, 'invoice_num' => $invoice_id, 'date_today' => $date_today, 'coupon' => $coupon, 'subtotal' => $subtotal, 'discount' => $discount, 'referral_discount'=>$refferal_discount, 'actualSubtotal' => $actutalsubtotal, 'actualTotal' => $actutaltotal, 'table_data' => $table_data,'emergency_money' => $emergency_money),
            function($message) use ($event){
                $message->from(env('ADMIN_EMAIL'), "Admin");
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
                        $email = env('ADMIN_EMAIL');
                        $user_name = "undefined";
                        $number = 00000000;
                    }
                    $message->to($email, $user_name)->subject('Pickup Request Details U-rang');
                    //$message->bcc($email, $user_name)->subject('Pickuprequest Details U-rang');
                }
                else
                {
                    //dd($event->req->user_email);
                    $message->to(isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email:$event->req->user_email, isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"username")->subject('Pickup Request Details U-rang');
                    //$message->bcc(isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email:$event->req->user_email, isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"username")->subject('Pickuprequest Details U-rang');
                }
            });
            
            

            $some1 = Mail::send('email.admin-pickupemail', array('username'=>$user_name, 'email' => $email, 'phone_num' => $number, 'invoice_num' => $invoice_id, 'date_today' => $date_today, 'coupon' => $coupon, 'subtotal' => $subtotal, 'discount' => $discount, 'referral_discount' => $refferal_discount, 'actualSubtotal' => $actutalsubtotal, 'actualTotal' => $actutaltotal,  'table_data' => $table_data,'emergency_money' => $emergency_money),
                function($message) use ($event){
                    $message->from(env('ADMIN_EMAIL'), "Admin");
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
                            $email = \App\Helper\ConstantsHelper::getClintEmail();
                            $user_name = "undefined";
                            $number = 00000000;
                        }
                        $message->from(isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email : $email, "New PickUp Request");
                        //$message->bcc($email, $user_name)->subject('Pickuprequest Details U-rang');
                    }
                    else
                    {

                        //dd($event->req->user_email);
                        $message->to(env('ADMIN_EMAIL'), "Admin")->subject('New Pickup Request On U-rang');
                        $message->bcc("Mr.anthonycleaners@gmail.com", "Admin")->subject('New Pickup Request On U-rang');
                        $message->bcc("Dan.jy.lee@gmail.com", "Admin")->subject('New Pickup Request On U-rang');
                        //$message->bcc(isset(auth()->guard('users')->user()->email)?auth()->guard('users')->user()->email:$event->req->user_email, isset(auth()->guard('users')->user()->user_details->name)?auth()->guard('users')->user()->user_details->name:"username")->subject('Pickuprequest Details U-rang');
                    }
                });

    }
}