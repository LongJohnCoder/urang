<?php

namespace App\Http\Controllers;
use App\Helper\NavBarHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Staff;
use App\User;
use App\Pickupreq;
use App\UserDetails;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use App\OrderDetails;
use App\SchoolDonations;
use App\Neighborhood;
use App\PaymentKeys;
use App\Invoice;
use App\SchoolDonationPercentage;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\CustomerCreditCardInfo;
use App\Http\Controllers\AdminController;
use App\Helper\SiteHelper;

class StaffController extends Controller
{
    public function __construct()
    {
        $paginate_limit = 2;
    }
    

    public function LoginAttempt(Request $request) 
    {
        
        $staff = auth()->guard('staffs');
        $user_name = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember)? true : false;
        //dd($remember_me);
        if ($staff->attempt(['user_name' => $user_name, 'password' => $password], $remember_me)) {
            $active = $staff->user()->active;
            if($active)
            {
                return redirect()->route('getStaffIndex');
            }
            else
            {
                return redirect()->route('getStaffLogin')->with('fail', 'This staff is blocked by admin!');
            }
            
        }
        else
        {
            return redirect()->route('getStaffLogin')->with('fail', 'wrong username or password');
        }
    }

    public function getLogout() {
        $user = auth()->guard('staffs');
        $user->logout();
        return redirect()->route('getStaffLogin');
    }

    public function getStaffLogin()
    {
        return view('staff.login');
    }

    public function getStaffIndex()
    {
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            $pickups = Pickupreq::orderBy('id','desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
            $orders_to_pick_up = Pickupreq::where('order_status',1)->with('user_detail','user','order_detail')->get();
            $orders_picked_up = Pickupreq::where('order_status',2)->with('user_detail','user','order_detail')->get();
            $orders_processed = Pickupreq::where('order_status',3)->with('user_detail','user','order_detail')->get();
            $orders_delivered = Pickupreq::where('order_status',4)->with('user_detail','user','order_detail')->get();
            return view('staff.index',compact('pickups','orders_to_pick_up','orders_picked_up','orders_processed','orders_delivered'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
        
    }
    public function getStaffOrders($value = null)
    {
        
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            if ($value) {
                if ($value == 'picked-up-orders') {
                    $pickups = Pickupreq::orderBy('id', 'desc')->where('order_status', 2)->with('user_detail','user','order_detail', 'invoice')->paginate((new \App\Helper\ConstantsHelper)->getPagination());   
                }
                else
                {
                    $pickups = Pickupreq::orderBy('id', 'desc')->where('order_status', 3)->with('user_detail','user','order_detail', 'invoice')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                }
            }
            else
            {
                $pickups = Pickupreq::where('order_status',1)->orderBy('id', 'desc')->with('user_detail','user','order_detail', 'invoice')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
            }

            $donate_money_percentage = SchoolDonationPercentage::first();

            return view('staff.orders',compact('pickups','donate_money_percentage'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
        
    }
    private function ChargeCard($id, $amount) {
        //fetch the record from databse
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $customer_credit_card = CustomerCreditCardInfo::where('user_id', $id)->first();
        $payment_keys = PaymentKeys::first();
        if ($payment_keys != null) {
            $merchantAuthentication->setName($payment_keys->login_id);
            $merchantAuthentication->setTransactionKey($payment_keys->transaction_key);
            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($customer_credit_card->card_no);
            $creditCard->setExpirationDate("20".$customer_credit_card->exp_year."-".$customer_credit_card->exp_month);
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setPayment($paymentOne);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            if ($payment_keys->mode == 1) {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            }
            else
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            //dd($response);
            if ($response != null) {
                $tresponse = $response->getTransactionResponse();
                if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
                {
                    return "I00001";
                }
                else
                {
                    return 2;
                }
            } 
            else
            {
                return 1;
            }
        } 
        else 
        {
            return 0;
        }
    }
    public function changeOrderStatus(Request $req)
    {
        $staff = auth()->guard('staffs')->user();
        if($staff) {
            //dd($req);
            //for login authntication its here
            if (isset($req->order_status)) {
                //order status selected or not
                if ($req->order_status == 1) {
                    //order placed
                    $data['order_status'] = $req->order_status;
                    $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                    if($result)
                    {
                        (new AdminController)->TrackOrder($req);
                        //return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                        return 1;
                    }
                    else
                    {
                        //return redirect()->route('getStaffOrders')->with('fail', 'Failed to update Order Status!');
                        return 0;
                    }
                }
                elseif ($req->order_status == 2) {
                    //picked up
                    $data['order_status'] = $req->order_status;
                    $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                    if($result)
                    {
                        (new AdminController)->TrackOrder($req);
                        //return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                        return 1;
                    }
                    else
                    {
                        //return redirect()->route('getStaffOrders')->with('fail', 'Failed to update Order Status!');
                        return 0;
                    }
                }
                elseif ($req->order_status == 3) {
                    //processed
                    $data['order_status'] = $req->order_status;
                    $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                    if($result)
                    {
                        (new AdminController)->TrackOrder($req);
                        //return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                        return 1;
                    }
                    else
                    {
                        //return redirect()->route('getStaffOrders')->with('fail', 'Failed to update Order Status!');
                        return 0;
                    }
                }
                else {

                    //delivered
                    $data['order_status'] = $req->order_status;
                    if ($req->payment_type == 1) {
                        //charge this card
                        $response = $this->ChargeCard($req->user_id, $req->chargable);
                        //dd($response);
                        if ($response == "I00001") {
                            $data['payment_status'] = 1;
                            (new AdminController)->TrackOrder($req);
                            //Session::put("success_code", "Payment Successfull!");
                            $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                            if($result)
                            {
                                //return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated and paid also!');
                                if(isset($req->actual_school_donation_id))
                                {
                                    if($req->actual_school_donation_id!=null)
                                    {
                                        $school_donation_actual = SchoolDonations::where('id',$req->actual_school_donation_id)->first();
                                        $school_donation_actual->actual_pending_money = $school_donation_actual->actual_pending_money+$req->actual_school_donation_amount;
                                        $school_donation_actual->save();
                                    }
                                    
                                }
                                return "I00001";
                            }
                            else
                            {
                                //return redirect()->route('getStaffOrders')->with('fail', 'Failed to update Order Status!');
                                return 0;
                            }
                        }
                        else
                        {
                            return $response;
                        }
                    } else {
                        //do not charge
                        $paidOrNOt = Pickupreq::where('id',$req->pickup_id)->first(); 
                        //dd($paidOrNOt);
                        if ($paidOrNOt->payment_status == 1) {
                            (new AdminController)->TrackOrder($req);
                            $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                            if($result)
                            {
                                //return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                                return 1;
                            }
                            else
                            {
                                //return redirect()->route('getStaffOrders')->with('fail', 'Failed to update Order Status!');
                                return 0;
                            }
                        } else {
                            //return redirect()->route('getStaffOrders')->with('fail', 'at first make sure payment is done!');
                            return "403";
                        }
                    }
                }
            } 
            else {
                //return redirect()->route('getStaffOrders')->with('fail', 'Select the status from dropdown you want to update');
                return "444";
            }
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }

        
    }

    public function getSearch()
    {
        $search = Input::get('search');
        
        
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            $pickups = Pickupreq::where('id',$search)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
            if($pickups)
            {
                Session::put('success', 'Search result found!');
                return view('staff.orders',compact('pickups'));
            }
            else
            {
                Session::put('error', 'Search result not found!');
                return view('staff.orders',compact('pickups'));
            }
            
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }

    }
    

    public function addItemCustom(Request $request)
    {
        //return $request;
        //dd($request);
        $data = json_decode($request->list_items_json);
        $user = Pickupreq::find($request->row_id);
        //$previous_price = $user->total_price;
        $price_to_add = 0.00;
        $new_total_price = 0.00 ;
        //$total_price_table_pickup = 0.00;
        for ($i=0; $i< count($data); $i++) 
        {
            $order_details = new OrderDetails();
            $order_details->pick_up_req_id = $request->row_id;
            $order_details->user_id = $request->row_user_id;
            $order_details->price = $data[$i]->item_price;
            $order_details->items = $data[$i]->item_name;
            $order_details->quantity = $data[$i]->number_of_item;
            $order_details->payment_status = 0;
            //$total_price_table_pickup = $data[$i]->item_price*$data[$i]->number_of_item;
            //$price_to_add = ($price_to_add+($data[$i]->item_price*$data[$i]->number_of_item));
            $order_details->save();
        }
        //check for item

        for ($j=0; $j< count($data); $j++) 
        {
            $invoice_find = Invoice::where('pick_up_req_id', $request->row_id)->where('user_id', $request->row_user_id)->where('invoice_id', $request->invoice_updt)->where('list_item_id',$data[$j]->id)->first();
            if ($invoice_find) {
                $invoice_find->quantity = $data[$j]->number_of_item;
                //$user->total_price = $data[$j]->number_of_item * $data[$j]->item_price;
                $invoice_find->save();
            }
            else
            {
                $invoice = new Invoice();
                $invoice->pick_up_req_id = $request->row_id;
                $invoice->user_id = $request->row_user_id;
                $invoice->invoice_id = $request->invoice_updt;
                $invoice->price = $data[$j]->item_price;
                $invoice->item = $data[$j]->item_name;
                $invoice->quantity = $data[$j]->number_of_item;
                $invoice->list_item_id = $data[$j]->id;
                $price_to_add = $price_to_add;
                //$user->total_price = $data[$j]->number_of_item * $data[$j]->item_price;
                $invoice->save();
            }
            
        }
        //$user->total_price = $previous_price+$price_to_add;
        //$new_total_price = $price_to_add;
        if ($user->school_donation_id != null) {
            $fetch_percentage = SchoolDonationPercentage::first();
            $new_percentage = $fetch_percentage->percentage/100;
            $school = SchoolDonations::find($user->school_donation_id);
            $present_pending_money = $school->pending_money;
            $updated_pending_money = $present_pending_money+($new_total_price*$new_percentage);
            $school->pending_money = $updated_pending_money;
            $school->save();
        }
        //}
        //upadte total price here
        $user = Pickupreq::find($request->row_id);
        if ($user) {
            $user->total_price = 0;
            $last_inv = Invoice::where('invoice_id', $request->invoice_updt)->get();
            foreach ($last_inv as $inv) {
                $user->total_price += $inv->quantity*$inv->price;
            }
        }
        //$7 emergency extra
        if ($user->is_emergency == 1) {
            if ($user->total_price > 0) {
                $user->total_price +=7;
                $user->save();
            }
        }
        if ($user->ref_discount == 1) {
            $calculate_discount = new SiteHelper();
            $user->discounted_value = $calculate_discount->updateTotalPriceOnRef($user->total_price);
        }
        if($user->save())
        {
            
            if ($user->coupon != null) {
                $calculate_discount = new SiteHelper();
                $discounted_value = $calculate_discount->discountedValue($user->coupon, $user->total_price);
                if ($user->ref_discount == 1) {
                    $calculate_discount = new SiteHelper();
                    $user->discounted_value  = $calculate_discount->updateTotalPriceOnRef($discounted_value);
                }
                else
                {
                    $user->discounted_value = $discounted_value;
                }
                //$user->discounted_value = $discounted_value;
                $user->save();
            }
            if($request->ajax())
            {
                return 1;
            }
            else
            {
                return redirect()->route('getStaffOrders')->with('success', 'Order successfully updated!');
            }
            
        }
        else
        {
            if($request->ajax())
            {
                return 0;
            }
            else
            {
                return redirect()->route('getStaffOrders')->with('error', 'Cannot update the order now!');
            }
            
        }
    }

    public function getSchoolDonationStaff() {
       $staff = auth()->guard('staffs')->user();
       if ($staff) {
            $list_school = SchoolDonations::with('neighborhood')->paginate(10);
            $neighborhood = Neighborhood::all();
            return view('staff.school-donation', compact('list_school', 'neighborhood'));
       }
       else
       {
        return redirect()->route('getStaffLogin');
       }
    }
    public function postEditSchoolStaff(Request $request) {
        //dd($request);
        $search = SchoolDonations::find($request->sch_id);
        if ($search) {
            $search->neighborhood_id = $request->neighborhood;
            $search->school_name = $request->school_name;
            if ($request->image) {
                $image = $request->image;
                $extension =$image->getClientOriginalExtension();
                $destinationPath = 'public/dump_images/';
                $fileName = rand(111111111,999999999).'.'.$extension;
                $image->move($destinationPath, $fileName);
                $search->image = $fileName;
            }
            $search->pending_money = $request->pending_money;
            $search->total_money_gained = $request->total_money_gained;
            if ($search->save()) {
                return redirect()->route('getSchoolDonationStaff')->with('success', 'Successfully Saved School !');
            }
            else
            {
                return redirect()->route('getSchoolDonationStaff')->with('fail', 'Failed to update some error occured !');
            }
        }
        else
        {
            return redirect()->route('getSchoolDonationStaff')->with('fail', 'Failed to find a School !');
        }
    }
    public function postDeleteSchoolStaff(Request $request) {
        $search_school = SchoolDonations::find($request->id);
        if ($search_school) {
            if ($search_school->delete()) {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function postPendingMoneyStaff(Request $request) {
        $search_school = SchoolDonations::find($request->id);
        if ($search_school) {
            $total_money_gained = $search_school->total_money_gained;
            $pending_money = $search_school->pending_money;
            //return 1;
            $search_school->total_money_gained = $total_money_gained+$pending_money;
            $search_school->pending_money = 0.00;
            if ($search_school->save()) {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function getMakePayments() {
        $staff = auth()->guard('staffs')->user();
        if ($staff) {
            $payment_keys = PaymentKeys::first();
            $user_details = Pickupreq::where('payment_type',1)->where('payment_status', 0)->with('user')->get();
            return view('staff.make-payment', compact('user_data', 'payment_keys', 'user_details', 'site_details'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
    }
    public function getManualPayment() {
       $staff = auth()->guard('staffs')->user();
        if ($staff) {
            $data = Pickupreq::where('payment_type', '!=', 1)->with('user')->paginate(10);
            return view('staff.manual_payment', compact('data'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
    }

    public function getSort()
    {
        //$obj = new NavBarHelper();
        //$user_data = $obj->getUserData();
        //$site_details = $obj->siteData();
        $input = Input::get('sort');
        $sort = isset($input) ? $input : false;
        if($sort)
        {
            if ($sort == 'paid') 
            {
                return redirect()->route('orderSortPaidStaff');
            } 
            else if($sort == 'unpaid') 
            {
                return redirect()->route('orderSortUnpaidStaff');
            }
            else if ($sort == 'delivered') 
            {
                return redirect()->route('orderSortDeliveredStaff');
            }
            else if($sort == 'is_Emergency') {

                return redirect()->route('orderSortEmergencyStaff');
            }
            else if($sort == 'total_price')
            {
                return redirect()->route('orderSortTotalPriceStaff');
            }
            else if($sort == 'pick_up_date')
            {
                return redirect()->route('orderSortPickUpDateStaff');
            }
            else if($sort == 'created_at')
            {
                return redirect()->route('orderSortCreatedAtStaff');
            }
            else {
                $pickups = Pickupreq::orderBy($sort,'desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
                return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
            }
        }
        else
        {
            return redirect()->route('getStaffOrders');
        }

    }

    public function orderSortDeliveredStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::where('order_status', 4)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortPaidStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::where('payment_status', 1)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortUnpaidStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::where('payment_status', 0)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortEmergencyStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::where('is_emergency', 1)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortTotalPriceStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::orderBy('total_price','desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortPickUpDateStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::orderBy('pick_up_date','desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }

    public function orderSortCreatedAtStaff()
    {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();

        $pickups = Pickupreq::orderBy('created_at','desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
        return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage', 'user_data', 'site_details'));
    }
}
