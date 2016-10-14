<?php

namespace App\Http\Controllers\ApiV1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\Helper\SiteHelper;
use App\Helper\NavBarHelper;
use App\Helper\ConstantsHelper;
use App\User;
use App\UserDetails;
use App\PriceList;
use App\CustomerCreditCardInfo;
use Illuminate\Support\Facades\Auth;
use Mail;
use Hash;
use App\Neighborhood;
use App\Faq;
use App\Pickupreq;
use App\OrderDetails;
use Illuminate\Support\Facades\Validator;
use App\Categories;
use App\SchoolDonations;
use App\Cms;
use App\OrderTracker;
use App\PickUpTime;
use App\SchoolDonationPercentage;
use App\SchoolPreferences;
use App\Invoice;
use App\Events\SendEmailOnSignUp;
use App\Events\SendCustomerComplaints;
use App\Events\PickUpReqEvent;
use App\Events\ResetPassword;
use Illuminate\Support\Facades\Event;
use App\Coupon;

class UserApiController extends Controller
{
    public function LoginAttempt(Request $req)
    {
    	//echo $req->email;
    	$user = auth()->guard('users');
    	if($user->attempt(['email' => $req->email, 'password' => $req->password]))
    	{
    		$userdata = $user->user();
    		
    		if($userdata->block_status)
    		{
    			return Response::json(array(
		            'status' => false,
		            'status_code' => 403,
		            'message' => 'This user is forbidden!'        
	        	));
    		}
    		else
    		{
    			$user_details = User::where('id',$userdata->id)->with('user_details')->first();
                $alldetails = $this->getAllRecordsWhileLogin($userdata->id);
	        	return Response::json(array(
		            'status' => true,
		            'status_code' => 200,
		            'response' => $user_details,
                    'alldetails' => $alldetails,
                    'message' => 'Loging in...'        
	        	));
    		}
    		
    	}
    	else
    	{
    		return Response::json(array(
	            'status' => false,
	            'status_code' => 400,
	            'message' => "User not found! Check the email and password."
        	));
    	}
    	
    }
    public function order_history(Request $req)
    {
    	$data['user_id'] = $req->user_id;
    	$pickups = Pickupreq::where($data)->orderBy('id', 'desc')->with('order_detail')->get();

    	if($pickups)
    	{
    		return Response::json(array(
	            'status' => true,
	            'status_code' => 200,
	            'response' => $pickups,        
	    	));
    	}
    	else
    	{
    		return Response::json(array(
	            'status' => true,
	            'status_code' => 400,
	            'message' => 'No order history found'        
	    	));
    	}

    	
    }
    public function placeOrder(Request $request)
    {
        if ($request->isCard == "yes") {
            $card_infos = new CustomerCreditCardInfo();
            $card_infos->user_id = $request->user_id;
            $card_infos->name = $request->name;
            $card_infos->card_no = $request->card_no;
            $card_infos->cvv = $request->cvv;
            $card_infos->exp_month = $request->exp_month;
            $card_infos->exp_year = $request->exp_year;
            $card_infos->save();
        }
        $total_price = 0.00;
        $pick_up_req = new Pickupreq();
        $pick_up_req->user_id = $request->user_id;
        $pick_up_req->address = $request->address;
        $pick_up_req->address_line_2 = $request->address_line_2;
        $pick_up_req->apt_no = $request->apt_no;
        $pick_up_req->pick_up_date = date("Y-m-d", strtotime($request->pick_up_date));
        $pick_up_req->pick_up_type = $request->pick_up_type;
        $pick_up_req->schedule = $request->schedule;
        $pick_up_req->delivary_type = $request->boxed_or_hung;
        $pick_up_req->starch_type = $request->strach_type;
        $pick_up_req->need_bag = isset($request->urang_bag) ? 1 : 0;
        $pick_up_req->door_man = $request->doorman;
        $pick_up_req->time_frame_start = $request->time_frame_start;
        $pick_up_req->time_frame_end = $request->time_frame_end;
        $pick_up_req->special_instructions = isset($request->spcl_ins) ? $request->spcl_ins: null;
        $pick_up_req->driving_instructions = isset($request->driving_ins) ? $request->driving_ins : null;
        $pick_up_req->payment_type = $request->pay_method;
        $pick_up_req->order_status = 1;
        $pick_up_req->is_emergency = $request->isEmergency;
        $pick_up_req->client_type = $request->client_type;
        $pick_up_req->coupon = $request->coupon;
        $pick_up_req->wash_n_fold = $request->wash_n_fold;

        $request->user_email = User::find($request->user_id)->email;
        $request->user_name = isset(UserDetails::where('user_id',$request->user_id)->first()->name)?UserDetails::where('user_id',$request->user_id)->first()->name:"Not Registered Yet";
        $request->user_number = isset(UserDetails::where('user_id',$request->user_id)->first()->personal_ph)?UserDetails::where('user_id',$request->user_id)->first()->personal_ph:"Number Not Registered Yet";
        //return $user_email;

        $data_table = json_decode($request->list_items_json);
        for ($i=0; $i< count($data_table); $i++) {
            $total_price += $data_table[$i]->item_price*$data_table[$i]->number_of_item;
        }
        $pick_up_req->total_price = $request->order_type == 1 ? 0.00 : $total_price;
        /*//for charging cards after wards
        $pick_up_req->chargeable = $request->order_type == 1 ? 0.00 : $total_price;*/

        if(isset($request->isEmergency)) {
                if ($pick_up_req->total_price > 0) {
                    //dd($total_price);
                    $total_price +=7;
                    $pick_up_req->total_price = $total_price;
                }
            }
            //coupon check
            if ($pick_up_req->coupon != null) {
                $calculate_discount = new SiteHelper();
                $discounted_value = $calculate_discount->discountedValue($pick_up_req->coupon, $total_price);
                //dd($discounted_value);
                $pick_up_req->discounted_value = $discounted_value;
            }

        if($request->isDonate)
        {
            $this->SavePreferncesSchool($request->user_id, $request->school_donation_id);
            $percentage = SchoolDonationPercentage::first();
            if ($percentage == null) 
            {
                $new_percentage = 0;
            }
            else
            {
                $new_percentage = $percentage->percentage/100;
            }
            $pick_up_req->school_donation_id = $request->school_donation_id;
            //$pick_up_req->school_donation_amount = $request->school_donation_amount;
            $search = SchoolDonations::find($request->school_donation_id);
            $present_pending_money = $search->pending_money;
            $updated_pending_money = $present_pending_money+($total_price*$new_percentage);
            $search->pending_money = $updated_pending_money;
            $search->save();
            $update_user_details = UserDetails::where('user_id', $request->user_id)->first();
            $update_user_details->school_id = $request->school_donation_id;
            $update_user_details->save();
        }
        if ($pick_up_req->save()) {
            //save in order tracker table
            $tracker = new OrderTracker();
            $tracker->pick_up_req_id = $pick_up_req->id;
            $tracker->user_id = $pick_up_req->user_id;
            $tracker->order_placed = $pick_up_req->created_at->toDateString();
            $tracker->order_status = 1;
            $tracker->original_invoice = $pick_up_req->total_price;
            $tracker->save();
            if ($request->order_type == 1) {
                //fast pick up
                $expected_time = $this->SayMeTheDate($pick_up_req->pick_up_date, $pick_up_req->created_at);
                dd("$request");
                Event::fire(new PickUpReqEvent($request, 0));
                return Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $pick_up_req->user_id,
                    'message' => "Order Placed successfully!".$expected_time        
                ));
            }
            else
            {
                $expected_time = $this->SayMeTheDate($pick_up_req->pick_up_date, $pick_up_req->created_at);
                //detailed pick up
                $data = json_decode($request->list_items_json);
                for ($i=0; $i< count($data); $i++) {
                    $order_details = new OrderDetails();
                    $order_details->pick_up_req_id = $pick_up_req->id;
                    $order_details->user_id = $request->user_id;
                    $order_details->price = $data[$i]->item_price;
                    $order_details->items = $data[$i]->item_name;
                    $order_details->quantity = $data[$i]->number_of_item;
                    $order_details->payment_status = 0;
                    $order_details->save();
                }
                //create invoice
                //dd($data);
                $global_invoice_id = "";
                for ($j=0; $j < count($data) ; $j++) { 
                    $invoice = new Invoice();
                    $invoice->user_id = $request->user_id;
                    $invoice->pick_up_req_id = $pick_up_req->id;
                    $invoice->invoice_id = $global_invoice_id = time();
                    $invoice->item = $data[$j]->item_name;
                    $invoice->quantity = $data[$j]->number_of_item;
                    $invoice->price = $data[$j]->item_price;
                    $invoice->list_item_id = $data[$j]->id;
                    //$invoice->coupon = $request->coupon;
                    $invoice->save();
                }
                dd("$request");
                Event::fire(new PickUpReqEvent($request, $global_invoice_id));
                return Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $pick_up_req->user_id,
                    'message' => "Order Placed successfully!".$expected_time        
                ));
            }
        }
        else
        {
           return Response::json(array(
                    'status' => false,
                    'status_code' => 500,
                    'message' => "Sorry! Cannot save the order now!"        
            ));
        }
    }


    public function SayMeTheDate($pick_up_date, $created_at) {
        //dd($pick_up_date);
        $date = $pick_up_date;
        $time = $created_at->toTimeString();
        $data = $this->returnData(date('l', strtotime($date)));
        if ($data != "E500" && $data != null) {
            if ($data->closedOrNot !=1) {

                if (strtotime($data->opening_time) <= strtotime($time) && strtotime($data->closing_time) >= strtotime($time)) {
                    $show_expected = "pick up day ". date('F j , Y', strtotime($date))."\n"."before ".date("h:i a", strtotime($data->closing_time));
                    return $show_expected;
                }
                else if (strtotime($data->closing_time) < strtotime($time)) {
                    $new_date = date('Y-m-d',strtotime($date)+86400);
                    return $this->SayMeTheDate($new_date, $created_at);
                }
                else if (strtotime($data->opening_time) > strtotime($time)) {
                    $new_date = date('Y-m-d',strtotime($date)-86400);
                    return $this->SayMeTheDate($new_date, $created_at);
                }
                else
                {
                    $show_expected = "Can't tell you real expected time admin might not set it up yet";
                   return $show_expected;
                }
            }
            else
            {
                $new_pickup_date = date('Y-m-d',strtotime($date)+86400);
                return $this->SayMeTheDate($new_pickup_date, $created_at);
            }
        }
        else
        {
            return "";
        }
    }

    private function returnData($day) {
        switch ($day) {
            case 'Monday':
                return  PickUpTime::where('day', 1)->first();
                break;
            case 'Tuesday':
                return  PickUpTime::where('day', 2)->first();
                break;
            case 'Wednesday':
                return  PickUpTime::where('day', 3)->first();
                break;
            case 'Thursday':
                return  PickUpTime::where('day', 4)->first();
                break;
            case 'Friday':
                return  PickUpTime::where('day', 5)->first();
                break;
            case 'Saturday':
                return  PickUpTime::where('day', 6)->first();
                break;
            case 'Sunday':
                return  PickUpTime::where('day', 7)->first();
                break;
            default:
                return "E500";
                break;
        }
    }


    public function checkEmail(Request $request)
    {
        if(User::where('email',$request->email)->first()) 
        {
            return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => "This email already exists!"        
                    ));
        }
        else
        {
            return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'message' => "Email can be taken!"        
                    ));
        }
    }
    public function userSignUp(Request $request)
    {
        if ($request->password == $request->conf_password) {

            if(User::where('email',$request->email)->first()) 
            {
                return Response::json(array(
                            'status' => false,
                            'status_code' => 400,
                            'message' => "This email already exists!"        
                        ));
            }
            else 
            {
                
                $user = new User();
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->block_status = 0;
                if ($user->save()) {
                    $user_details = new UserDetails();
                    $user_details->user_id = $user->id;
                    $user_details->name = $request->name;
                    $user_details->address = $request->address;
                    $user_details->personal_ph = $request->personal_phone;
                    $user_details->cell_phone = isset($request->cell_phone) ? $request->cell_phone : NULL;
                    $user_details->off_phone = isset($request->office_phone) ? $request->office_phone : NULL;
                    $user_details->spcl_instructions = isset($request->spcl_instruction) ? $request->spcl_instruction : NULL;
                    $user_details->driving_instructions = isset($request->driving_instruction) ? $request->driving_instruction : NULL;
                    if ($user_details->save()) {
                        $card_info = new CustomerCreditCardInfo();
                        $card_info->user_id = $user_details->user_id;
                        $card_info->name = $request->cardholder_name;
                        $card_info->card_no = $request->card_no;
                        $card_info->card_type = $request->cardtype;
                        $card_info->cvv = isset($request->cvv) ? $request->cvv : NULL;
                        $card_info->exp_month = $request->select_month;
                        $card_info->exp_year = $request->select_year;
                        if ($card_info->save()) {
                            
                             //return redirect()->route('getLogin')->with('success', 'You have successfully registered please login');
                            $data['user_id'] = $card_info->user_id;
                            return Response::json(array(
                                'status' => true,
                                'status_code' => 200,
                                'response' => $data,
                                'message' => "Registration successfull"        
                            ));
                        }
                        else
                        {
                            return Response::json(array(
                                'status' => false,
                                'status_code' => 500,
                                'message' => "Sorry! Cannot save your card details!"        
                            ));
                        }
                    }
                    else
                    {
                        return Response::json(array(
                                'status' => false,
                                'status_code' => 500,
                                'message' => "Sorry! Cannot save your user details!"        
                            ));
                        
                    }
                }
                else
                {                
                        return Response::json(array(
                                'status' => false,
                                'status_code' => 500,
                                'message' => "Sorry! Cannot save your user details!"        
                            ));
                }   
            }
            
        }
        else
        {
            return Response::json(array(
                            'status' => false,
                            'status_code' => 400,
                            'message' => "Password and Confirm Password did not matched!"        
                        ));
        }
    }
    public function SavePreferncesSchool($userId, $schoolId) {
        $find_school = SchoolPreferences::where('user_id', $userId)->where('school_id', $schoolId)->first();
        if ($find_school) {
            return 0;
        } else {
            $new_rec = new SchoolPreferences();
            $new_rec->user_id = $userId;
            $new_rec->school_id = $schoolId;
            if ($new_rec->save()) {
                return 1;
            } else {
                return "500";
            }
        }
    }
    public function getPrices()
    {
    	$price_list = Categories::with('pricelists')->get();
    	if($price_list)
    	{
    		return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $price_list        
			    	));
    	}
    	else
    	{
    		return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No price list to show!"        
			    	));
    	}
    }
    public function getNeighborhood()
    {
    	$obj = new NavBarHelper();
        $neighborhood = $obj->getNeighborhood();
        if($neighborhood)
        {
        	return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $neighborhood        
			    	));
        }
        else
        {
        	return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No neighborhood to show!"        
			    	));
        }
    }
    public function getFaq()
    {
    	$faqs = Faq::all();
    	if($faqs)
    	{
    		return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $faqs        
			    	));
    	}
    	else
    	{
    		return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No Faqs to show!"        
			    	));
    	}
    }
    public function contactUs(Request $request)
    {
    	

    	$firstname = $request->firstName;
        $lastname = $request->lastName;
        $email = $request->email;
        $subject = $request->subject;
        $text = $request->message;
        //dd($message);
        $phone = $request->phone;

            $flag=Mail::send('pages.sendEmailContact', ['firstName'=>$firstname,'lastName'=>$lastname,'email'=>$email,'subject'=>$subject,'text'=>$text,'phone'=>$phone], function($msg) use($request)
                        {
                            $msg->from($request->email, 'U-rang');
                            $msg->to("lisa@u-rang.com", $request->firstName)->subject('U-rang Details');
                        });

            if($flag==1)
            {
                return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Email is sent"        
			    	));
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Email is not sent!"        
			    	));
            }
    }
    /*public function updateProfile(Request $request)
    {

        $update_id = $request->user_id;
        //dd($update_id);
        if(User::where('email',$request->email)->first()) 
		{
		    return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "This email already exists!"        
			    	));
		}
        $user = User::find($update_id);
        //dd($user);
        $user->email = $request->email;
        if ($user->save()) {
            $user_details = UserDetails::where('user_id', $update_id)->first();
            //dd($user_details);
            $user_details->user_id = $update_id;
            $user_details->name = $request->name;
            $user_details->address = $request->address;
            $user_details->personal_ph = $request->personal_phone;
            $user_details->cell_phone = $request->cell_phone != null ? $request->cell_phone : '';
            $user_details->off_phone = $request->office_phone != null ? $request->office_phone: '';
            $user_details->spcl_instructions = $request->spcl_instruction != null ? $request->spcl_instruction: '';
            $user_details->driving_instructions = $request->driving_instruction != null ? $request->driving_instruction : '';
            if ($user_details->save()) {
                $card_info = CustomerCreditCardInfo::where('user_id' , $update_id)->first();
                //dd($card_info);
                $card_info->user_id = $update_id;
                $card_info->name = $request->cardholder_name;
                $card_info->card_no = $request->card_no;
                $card_info->card_type = $request->cardtype;
                $card_info->cvv = $request->cvv;
                $card_info->exp_month = $request->select_month;
                $card_info->exp_year = $request->select_year;
                if ($card_info->save()) {

                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Details successfully updated!"        
			    	));
                }
                else
                {
                   return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your card details!"        
			    	)); 
                }
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your user details!"        
			    	));
            }
        }
        else
        {
            return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your user details!"        
			    	));
        }
    }*/
    public function changePassword(Request $request)
    {
    	if ($request->new_password == $request->conf_password) {
            $id = $request->user_id;
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $user = User::find($id);
            if (Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
                if ($user->save()) {
                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Password successfully updated!"        
			    	));
                }
                else
                {
                   return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your password now! Please try again later!"        
			    	)); 
                }
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Old password did not matched with our!"        
			    	));
            }
        }
        else
        {
            return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Password and confirm password did not matched!"        
			    	));
        }
    }
    public function deletePickup(Request $request)
    {
    	$id_to_del = $request->pickup_id;
        $search = Pickupreq::find($id_to_del);
        if ($search) {
           if ($search->pick_up_type == 0) {
                $search->delete();
                $search_order_details = OrderDetails::where('pick_up_req_id', $id_to_del)->get();
                foreach ($search_order_details as $details) {
                    $details->delete();
                }
                return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Detailed pickup successfully deleted!"        
			    	));
           }
           else
           {
                if ($search->delete()) {
                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Fast pickup successfully deleted!"        
			    	));
                }
                else
                {
                    return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not delete the pickup!"        
			    	)); 
                }
           }
        }
        else
        {
           return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Cannot find the pickup you are looking for!"        
			    	));
        }
    }
    public function postPickUpType(Request $request) {
        //return $request->id;
        if (trim($request->id) != null) {
            $pick_up_req = Pickupreq::where('user_id',$request->id)->get();
            $placed_order = 0;
            $picked_up_order = 0;
            $processed_order = 0;
            $delivered_order =0;
            foreach ($pick_up_req as $req) {
                $order_status = $req->order_status;
                switch ($order_status) {
                  case '1':
                    $placed_order++;
                    break;
                  case '2':
                     $picked_up_order++;
                    break;
                  case '3':
                     $processed_order++;
                    break;
                  case '4':
                     $delivered_order++;
                    break;
                  default:
                    echo "Something went wrong error!";
                    break;
                }
            }
            return Response::json(array(
                'status' => true ,
                'status_code' => 200,
                'response' => array(
                    'total_pick_up' => count($pick_up_req),
                    'scheduled_pick_up' => $placed_order,
                    'picked_up_order' => $picked_up_order,
                    'processed_pick_up' => $processed_order,
                    'delivered_pick_up_req' => $delivered_order
                )
            ));
        }
        else
        {
            return Response::json(array(
                'status' => false ,
                'status_code' => 400,
                'message' => 'User id cannot be null!'
            ));
        }
    }
    public function postSchoolLists() {
        $school_list = SchoolDonations::all();
        if ($school_list) {
           return Response::json(array(
                'status' => true,
                'status_code' => 200,
                'response' => $school_list
            ));
        }
        else
        {
            return  Response::json(array(
                'status' => false ,
                'status_code' => 400,
                'message' => 'No School exists!'
            ));
        }
    }
    public function postServicesApi(Request $request) {
        switch ($request->id) {
            case '0':
                $services = Cms::where('identifier', 0)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '1':
                $services = Cms::where('identifier', 1)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '2':
                $services = Cms::where('identifier', 2)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '3':
                $services = Cms::where('identifier', 3)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '4':
                $services = Cms::where('identifier', 4)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            default:
                return  Response::json(array(
                    'status' => false ,
                    'status_code' => 400,
                    'message' => 'Bad request!'
                ));
                break;
        }
    }

    public function userDetails(Request $request)
    {
        $user_details = User::where('id',$request->user_id)->with('user_details','card_details')->first();
        if($user_details)
        {
            return  Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $user_details
                ));
        }
        else
        {
            return  Response::json(array(
                    'status' => false ,
                    'status_code' => 400,
                    'message' => 'User does not exists! Please try to login again.'
                ));
        }
    }

    public function social_Login(Request $request)
    {
        //dd($request->user_id);
            if(User::where('email',$request->email)->first()) 
            {
                $user_data = User::where('email',$request->email)->first();
                if($user_data->block_status == 0)
                {
                    $alldetails = $this->getAllRecordsWhileLogin($user_data->id);
                    return Response::json(array(
                            'status' => true,
                            'status_code' => 200,
                            'response' => $user_data,
                            'alldetails' => $alldetails,
                            'message' => "Loging In..!"        
                        ));
                }
                else
                {
                    return Response::json(array(
                            'status' => false,
                            'status_code' => 400,
                            'message' => "You are blocked by the admin!"        
                        ));
                }
                
            }
            else
            {
                $user = new User();
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->block_status = 0;
                if ($user->save()) 
                {
                    $user_details = new UserDetails();
                    $user_details->user_id = $user->id;
                    $user_details->name = $request->name;
                    $user_details->social_network = 1;
                    $user_details->social_network_name = $request->social_network_name;
                    $user_details->social_id = $request->social_id;
                    if($user_details->save())
                    {
                        $user_data = User::where('email',$request->email)->first();
                        $alldetails = $this->getAllRecordsWhileLogin($user_data->id);
                        return Response::json(array(
                            'status' => true,
                            'status_code' => 200,
                            'response' => $user_data,
                            'alldetails' => $alldetails,
                            'message' => "Registered and Loging In..!"        
                        ));
                    }
                    else
                    {
                        return Response::json(array(
                                'status' => false,
                                'status_code' => 500,
                                'message' => "Sorry! Cannot save your user details!"        
                            ));
                    }
                }
                else
                {
                    return Response::json(array(
                                'status' => false,
                                'status_code' => 500,
                                'message' => "Sorry! Cannot register you now!"        
                            ));
                }
            }
    }

    public function getAllRecordsWhileLogin($user_id)
    {
        $pick_up_req = Pickupreq::where('user_id',$user_id)->orderBy('id', 'desc')->with('OrderTrack')->get();

        return $pick_up_req;
    }
    public function getPickUpTimes(Request $request) {
        $all_the_times = PickUpTime::all();
        if ($all_the_times) {
            return Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $all_the_times
                ));
        } else {
            return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => "No Time entered by admin!"        
                    ));
        }
    }
    public function getOrderTracker(Request $request)
    {
        $order_track = OrderTracker::where('user_id',$request->user_id)->orderBy('id','desc')->get();

        if($order_track)
        {
            return Response::json(array(
                            'status' => true,
                            'status_code' => 200,
                            'response' => $order_track,      
                        ));
        }
        else
        {
            return Response::json(array(
                                'status' => false,
                                'status_code' => 400,
                                'message' => "No order to show!"        
                            ));
        }
        
    }

    public function showSchoolPreferences(Request $request)
    {
            $school_preferences = SchoolPreferences::where('user_id',$request->user_id)->with('schoolDonation')->get();
            $school_list = SchoolDonations::all();
            if($school_preferences)
            {
                return Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $school_preferences,
                    'school_list' => $school_list
                ));
            }
            else
            {
                return Response::json(array(
                                'status' => false,
                                'status_code' => 400,
                                'message' => "No favourite schools!"        
                            ));
            }

    }

    public function addSchoolToPreference(Request $request)
    {
        $find_school = SchoolPreferences::where('user_id', $request->user_id)->where('school_id', $request->school_id)->first();
        if($find_school)
        {
                return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "This school is already added!"        
                                ));
        }
        else
        {
            $school_preferences = new SchoolPreferences();
            $school_preferences->user_id = $request->user_id;
            $school_preferences->school_id = $request->school_id;
            if($school_preferences->save())
            {
                    return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'message' => "School saved!"        
                                ));
            }
            else
            {
                return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Cannot add favourite school!"        
                                ));
            }
        }
        
    }

    public function getCreditCardDetails(Request $request)
    {
        $creditCard_info = CustomerCreditCardInfo::where('user_id', $request->user_id)->first();

        if($creditCard_info)
        {
            return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'response' => $creditCard_info        
                                ));
        }
        else
        {
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "no card details found"        
                                ));
        }

    }

    public function cancleOrder(Request $request)
    {
        $pick_up_id = $request->pick_up_id;

        $pickup = Pickupreq::find($pick_up_id);
        $pickup->order_status = 5;
        if($pickup->save())
        {
            $order_tracker = OrderTracker::where('pick_up_req_id',$pick_up_id)->first();
            $order_tracker->order_status = 5;
            if($order_tracker->save())
            {
                return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'message' => "Order cancelled."        
                                ));
            }
            else
            {
                return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Could not cancle your order!"        
                                ));
            }
        }
        else
        {
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Could not cancle your order!"        
                                ));
        }
    }

    public function postForgotPassword(Request $request) 
    {
        $search_user = User::where('email', $request->forgot_pass_user_email)->first();
        if ($search_user != null && $search_user->block_status == 0) {
            //dd(base64_encode($search_user->id));
            Event::fire(new ResetPassword($search_user));
            /*return redirect()->route('getForgotPassword')->with('success', "password reset email has been sent to your email. Did not receive one? try again after 1 min.");*/
            return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'message' => "password reset email has been sent to your email. Did not receive one? try again after 1 min."        
                                ));
        }
        else
        {
            /*return redirect()->route('getForgotPassword')->with('fail', "Could not find user of this email or make sure you are not blocked");*/
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Could not find user of this email or make sure you are not blocked"        
                                ));
        }
    }

    public function checkCoupon(Request $request)
    {
        $coupon_details = Coupon::where('coupon_code',$request->coupon)->first();
        if($coupon_details)
        {
            if($coupon_details->isActive)
            {
                return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'response' => $coupon_details        
                                ));
            }
            else
            {
                return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Coupon is no longer valid"        
                                ));
            }
            
        }
        else
        {
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Invalid coupon"        
                                ));
        }
    }

    public function getProgileDetails(Request $request)
    {
        $search = User::find($request->user_id);
        if($search)
        {
            $customer_details = User::with('user_details', 'card_details','pickup_req')->where('id' , $request->user_id)->first();
            return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'response' => $customer_details        
                                ));
        }
        else
        {
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "User Does not exists!"        
                                ));
        }
        
    }

    public function updateProfile(Request $request)
    {

        $update_id = $request->user_id;
        //dd($update_id);
        $user = User::find($update_id);
        //dd($user);
        $user->email = $request->email;
        if ($user->save()) {
            $user_details = UserDetails::where('user_id', $update_id)->first();
            //dd($user_details);
            $user_details->user_id = $update_id;
            $user_details->name = $request->name;
            $user_details->address = $request->address;
            $user_details->personal_ph = $request->personal_phone;
            $user_details->cell_phone = $request->cell_phone != null ? $request->cell_phone : '';
            $user_details->off_phone = $request->office_phone != null ? $request->office_phone: '';
            $user_details->spcl_instructions = $request->spcl_instruction != null ? $request->spcl_instruction: '';
            $user_details->driving_instructions = $request->driving_instruction != null ? $request->driving_instruction : '';
            
            if ($user_details->save()) 
            {

                return Response::json(array(
                                    'status' => true,
                                    'status_code' => 200,
                                    'message' => "Details Updated successfully."        
                                ));
            }
               
        }
        else
        {
            return Response::json(array(
                                    'status' => false,
                                    'status_code' => 400,
                                    'message' => "Cannot update now!"        
                                ));
        }
    } 
}
