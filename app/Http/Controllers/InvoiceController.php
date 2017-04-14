<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Invoice;
use App\Pickupreq;
use App\SchoolDonations;
use App\SchoolDonationPercentage;
use App\UserDetails;
use App\Coupon;
use App\Helper\SiteHelper;
class InvoiceController extends Controller
{
    /*public function index() {
    	dd($data);
    	return view('invoices.invoice');
    }*/
    public function postInvoice(Request $request) {
        //dd($request);
        if ($request->list_item != null) {
            $total_price = 0.00;
            //$itemList=explode(',',$request->list_item);
            $data = json_decode($request->list_item);
            for ($i=0; $i< count($data); $i++) {
                $save_invoice = new Invoice();
                $save_invoice->user_id = $request->req_user_id;
                $save_invoice->pick_up_req_id = $request->pick_up_req_id;
                $save_invoice->invoice_id = time();
                $save_invoice->item = $data[$i]->item_name;
                $save_invoice->quantity = $data[$i]->number_of_item;
                $save_invoice->price = $data[$i]->item_price;
                $total_price += $data[$i]->number_of_item*$data[$i]->item_price;
                $save_invoice->list_item_id = $data[$i]->id;
                $save_invoice->save();
            }
             /*for($i=0;$i<count($itemList);$i++)
             {
                $items=$itemList[$i];
                if($items!='')
                {
                    $item_each = explode('^%', $items);
                    for ($j=0; $j <count($item_each) ; $j++) { 
                        $id =  $item_each[0];
                        $item_name = $item_each[2];
                        $qty = $item_each[1];
                        $price =$item_each[3];
                    }
                    $save_invoice = new Invoice();
                    $save_invoice->user_id = $request->req_user_id;
                    $save_invoice->pick_up_req_id = $request->pick_up_req_id;
                    $save_invoice->invoice_id = time();
                    $save_invoice->item = $item_name;
                    $save_invoice->quantity = $qty;
                    $save_invoice->price = $price;
                    $total_price += $qty*$price;
                    $save_invoice->list_item_id = $id;
                    $save_invoice->save();
                }
             }*/
             //dd($request->pick_up_req_id);
             $payOrNot= Pickupreq::find($request->pick_up_req_id);
             //dd();
             //$user_info = UserDetails::where('user_id', $request->req_user_id)->first();
             if ($payOrNot->school_donation_id != null) {
                $fetch_percentage = SchoolDonationPercentage::first();
                //dd($fetch_percentage);
                if ($fetch_percentage == null) {
                    $new_percentage = 0;
                }
                else
                {
                    $new_percentage = $fetch_percentage->percentage/100;
                }
                $school = SchoolDonations::find($payOrNot->school_donation_id);
                if ($school) {
                    $present_pending_money = $school->pending_money;
                    $updated_pending_money = $present_pending_money+($total_price*$new_percentage);
                    $school->pending_money = $updated_pending_money;
                    $school->save();
                }
             }
             $search_pickupreq = Pickupreq::find($request->pick_up_req_id);

             //dd($search_pickupreq);
             //emergency $7 extra
             if ($search_pickupreq->is_emergency == 1) {
                if ($total_price > 0) {
                    $total_price +=7;
                }
            }

            if($search_pickupreq->sign_up_discount==1)
            {

                $signupDiscount=$total_price - ($total_price*10/100);

                $search_pickupreq->discounted_value=$signupDiscount;

            }
            else
            {
                $search_pickupreq->discounted_value=$total_price;
            }

            if ($search_pickupreq->ref_discount == 1) {
                 $calculate_discount = new SiteHelper();
                 $discounted_value = $calculate_discount->updateTotalPriceOnRef($total_price);
                 $search_pickupreq->discounted_value = $discounted_value;
                 $search_pickupreq->save();
             }
             if ($search_pickupreq->coupon != null) {
                $calculate_discount = new SiteHelper();
                $discounted_value = $calculate_discount->discountedValue($search_pickupreq->coupon, $total_price);
                //dd($discounted_value);
                if ($search_pickupreq->ref_discount == 1) {
                    $calculate_discount = new SiteHelper();
                    $search_pickupreq->discounted_value  = $calculate_discount->updateTotalPriceOnRef($discounted_value);
                }
                else
                {
                    $search_pickupreq->discounted_value = $discounted_value;
                }
                //$search_pickupreq->discounted_value = $discounted_value;
                $search_pickupreq->save();
             }
             $search_pickupreq->total_price = $total_price;
             if ($search_pickupreq->save()) {
                if ($request->identifier == 'staff') {
                    //return redirect()->route('getStaffOrders')->with('success', "Invoice Successfully created");
                    return 1;
                }

                else  {
                   //return redirect()->route('getCustomerOrders')->with('success', "Invoice Successfully created");
                    return 1;
                }
            }
            else
            {
                if ($request->identifier == 'staff') {
                    //return redirect()->route('getStaffOrders')->with('fail', "Some error occured failed to update total price");
                    return 0;
                }
                else
                {
                    //return redirect()->route('getCustomerOrders')->with('fail', "Some error occured failed to update total price");
                    return 0;
                }
                
            }
        }
        else
        {
            if ($request->identifier == 'staff') {
                //return redirect()->route('getStaffOrders')->with('fail', "Please select atleast one list item");
                return 2;
            }
            else
            {
                //return redirect()->route('getCustomerOrders')->with('fail', "Please select atleast one list item");
                return 2;
            }
        }
    }
    public function postDeleteInvoice(Request $request) {
    	$search = Invoice::where('invoice_id', $request->invoice_id)->get();
    	foreach ($search as $element) {
    		$element->delete();
    	}
    	return 1;
    }
    public function showInvoiceUser(Request $request) {
    	$search_invoice = Invoice::where('pick_up_req_id', $request->id)->with('user', 'user_details', 'pick_up_req')->get();
        $school_details_id = 0;
    	if (count($search_invoice) > 0) {
            for ($i=0; $i < 1; $i++) { 
                $school_details_id = $search_invoice[$i]->pick_up_req->school_donation_id;
            }
            $school_details = SchoolDonations::find($school_details_id);
            $school_donation_per = SchoolDonationPercentage::first();
    		return view('invoices.invoice', compact('search_invoice', 'school_details', 'school_donation_per'));
    	}
    	else
    	{
    		return redirect()->route('getMyPickUp')->with('fail', 'Invoice is not generated yet by admin');
    	}
    }
    public function fetchPercentageCoupon(Request $request) {
        //return $request;
        $search = Coupon::where('coupon_code', $request->coupon)->where('isActive', 1)->first();
        if ($search) {
            return $search->discount;
        } else {
            return 0;
        }
    }
    public function UpDateExtraItem(Request $request) {
        //return $request;
        $find_update = Invoice::where('custom_item_add_id', $request->custom_item_add_id)->first();
        $total_price = 0.00;
        if ($find_update) {
            $find_update->user_id = $request->user_id;
            $find_update->pick_up_req_id = $request->pick_up_req_id;
            $find_update->invoice_id = $request->invoice_id;
            $find_update->item = $request->item_name;
            $find_update->quantity = $request->qty;
            $find_update->price = $request->price;
            $find_update->custom_item_add_id = $request->custom_item_add_id;
            //$total_price = $request->qty*$request->price;
            if ($find_update->save()) {
                //reset total price in pickupreq table
                $getPickUpReq= Invoice::where('pick_up_req_id', $request->pick_up_req_id)->get();
                if ($getPickUpReq) {
                    foreach ($getPickUpReq as $pickup) {
                        $total_price += ($pickup->quantity*$pickup->price);    
                    }
                    //return $total_price;
                    $find_pickup = Pickupreq::find($request->pick_up_req_id);
                    //return $find_pickup;
                    if ($find_pickup) {
                        if($find_pickup->is_emergency==0)
                        {
                            $find_pickup->total_price = $total_price;
                            $find_pickup->save();
                        }
                        else
                        {
                            $find_pickup->total_price = $total_price+7;
                            $find_pickup->save();
                        }
                    }
                    //return $find_pickup->total_price;
                }
                if ($find_pickup->ref_discount == 1) {
                    //return $total_price;
                    $calculate_discount = new SiteHelper();
                    $discounted_value = $calculate_discount->updateTotalPriceOnRef($total_price);
                    $find_pickup->discounted_value = $discounted_value;
                    $find_pickup->save();
                }
                if ($find_pickup->coupon != null) {
                    $calculate_discount = new SiteHelper();
                    $discounted_value = $calculate_discount->discountedValue($find_pickup->coupon, $find_pickup->total_price);
                    if ($find_pickup->ref_discount == 1) {
                        $calculate_discount = new SiteHelper();
                        $find_pickup->discounted_value  = $calculate_discount->updateTotalPriceOnRef($discounted_value);
                    }
                    else
                    {
                        $find_pickup->discounted_value = $discounted_value;
                    }
                    //$find_pickup->discounted_value = $discounted_value;
                    $find_pickup->save();
                }
                return 1;
            }
            else
            {
                return 2;
            }
        }
        else
        {
            return 0;
        }
    }
    public function pushAnItemInVoice(Request $request) {
        //return $request;
        $save_invoice = new Invoice();
        $save_invoice->user_id = $request->user_id;
        $save_invoice->pick_up_req_id = $request->pick_up_req_id;
        $save_invoice->invoice_id = $request->invoice_id;
        $save_invoice->item = $request->item_name;
        $save_invoice->quantity = $request->qty;
        $save_invoice->price = $request->price;
        $save_invoice->custom_item_add_id = $request->custom_item_add_id;
        $total_price = $request->qty*$request->price;
        if ($save_invoice->save()) {
            $find_pickup = Pickupreq::find($request->pick_up_req_id);
            if ($find_pickup) {
                $find_pickup->total_price += $total_price;
                if ($find_pickup->save()) {
                    if ($find_pickup->coupon != null) {
                        $calculate_discount = new SiteHelper();
                        $discounted_value = $calculate_discount->discountedValue($find_pickup->coupon, $total_price);
                        //return $discounted_value;
                        //$find_pickup->discounted_value = 0;
                        if ($find_pickup->ref_discount == 1) {
                            $calculate_discount = new SiteHelper();
                            
                            $find_pickup->discounted_value  += $calculate_discount->updateTotalPriceOnRef($discounted_value);
                        }
                        else
                        {

                            $find_pickup->discounted_value += $discounted_value;
                        }
                        //$find_pickup->discounted_value += $discounted_value;
                        if ($find_pickup->save()) {
                            return 1;
                        }
                        else
                        {
                            return "Error while saving discounted value";
                        }
                    }
                     if ($find_pickup->ref_discount == 1) {
                        $calculate_discount = new SiteHelper();
                        $find_pickup->discounted_value += $calculate_discount->updateTotalPriceOnRef($total_price);
                        $find_pickup->save();
                    }
                    return 1;
                } else {
                    return "Cannot Update total price";
                }
            } else {
                return "Could NOt find Pick up request related to this id";
            }
        } else {
            return "Could Not Save Your Data";
        }
    }
}
