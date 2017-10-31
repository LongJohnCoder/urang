<?php

namespace App\Http\Controllers;

use App\CustomerCreditCardInfo;
use App\Helper\NavBarHelper;
use App\PaymentKeys;
use App\Pickupreq;
use App\SchoolDonationPercentage;
use App\SchoolDonations;
use App\User;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class PaymentController extends Controller
{
	public function postGetCustomerCreditCard(Request $request) {
		//return $request;
		$credit_card_info = CustomerCreditCardInfo::where('user_id', $request->id)->first();
		return $credit_card_info;
	}
	public function getPayment() {
		$obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $payment_keys = PaymentKeys::first();
        //$user_details = Pickupreq::where('payment_type',1)->where('payment_status', 0)->with('user')->get();
        $user_details = Pickupreq::with('user')->get();

       // dd($user_details);
		return view('admin.payment', compact('user_data', 'payment_keys', 'user_details', 'site_details'));
	}

    public function chargePayment(Request $request)
    {
        if (preg_match('/^([0-9]{4})-([0-9]{2})$/', $request->input('exp_date'))) {
            $paymentKey = PaymentKeys::first();
            if ($paymentKey) {
                if ($paymentKey->mode) {
                    if ($request->has('pick_up_re_id') && strlen(trim($request->input('pick_up_re_id')))) {
                        $pickUpRequest = Pickupreq::whereId($request->input('pick_up_re_id'))
                            ->wherePaymentStatus(0)
                            ->first();
                        if ($pickUpRequest) {
                            $customer = CustomerCreditCardInfo::whereUserId($pickUpRequest->user_id)->first();
                            if ($customer) {
                                Stripe::setApiKey($paymentKey->transaction_key); // Stripe Secret API Key

                                try {
                                    $charge = Charge::create([
                                        "amount" => $request->has('amount') ?
                                            $request->input('amount') * 100 : 0, // Convert $ to Cent
                                        "currency" => "usd",
                                        "description" => "Payment received",
                                        "customer" => $customer->stripe_customer_id
                                    ]);
                                } catch (\Stripe\Error\RateLimit $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                } catch (\Stripe\Error\InvalidRequestError $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                } catch (\Stripe\Error\AuthenticationError $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                } catch (\Stripe\Error\ApiConnectionError $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                } catch (\Stripe\Error\Error $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                } catch (\Exception $e) {
                                    return redirect()->back()->with('fail', $e->getMessage());
                                }

                                if ($charge->captured && $charge->paid) {
                                    $pickUpRequest->payment_status = 1;
                                    $pickUpRequest->order_status = 4;
                                    $pickUpRequest->save();

                                    if ($request->has('school_donation_id')
                                        && strlen(trim($request->input('school_donation_id')))) {
                                        /*
                                         * Donate to school, get the percentage
                                         */
                                        $percentage = SchoolDonationPercentage::first();
                                        if ($percentage) {
                                            $school = SchoolDonations::find($request->input('school_donation_id'));
                                            if ($school) {
                                                $school->actual_pending_money +=
                                                    ($request->input('amount') * $percentage->percentage) / 100;
                                                if ($school->save()) {
                                                    if ($request->has('i_m_staff')
                                                        && strlen(trim($request->input('i_m_staff')))) {
                                                        return redirect()
                                                            ->route('getMakePayments')
                                                            ->with('success', "Payment was successful!");
                                                    } else {
                                                        return redirect()
                                                            ->route('getPayment')
                                                            ->with('success', "Payment was successful!");
                                                    }
                                                } else {
                                                    if ($request->has('i_m_staff')
                                                        && strlen(trim($request->input('i_m_staff')))) {
                                                        return redirect()
                                                            ->route('getMakePayments')
                                                            ->with('success', "Payment was successful but cannot
                                                            donate to the school. Hint: error while saving data!");
                                                    } else {
                                                        return redirect()
                                                            ->route('getPayment')
                                                            ->with('success', "Payment was successful but cannot
                                                            donate to the school. Hint: error while saving data!");
                                                    }
                                                }
                                            } else {
                                                if ($request->has('i_m_staff')
                                                    && strlen(trim($request->input('i_m_staff')))) {
                                                    return redirect()
                                                        ->route('getMakePayments')
                                                        ->with('success', "Payment was successful but cannot donate
                                                        to the requested school. Hint: could not locate it!");
                                                } else {
                                                    return redirect()
                                                        ->route('getPayment')
                                                        ->with('success', "Payment was successful but cannot donate 
                                                        to the requested school. Hint: could not locate it!");
                                                }
                                            }
                                        } else {
                                            if ($request->has('i_m_staff')
                                                && strlen(trim($request->input('i_m_staff')))) {
                                                return redirect()
                                                    ->route('getMakePayments')
                                                    ->with('success', "Payment was successful but money is not
                                                    donated Hint: set the school donation percentage!");
                                            } else {
                                                return redirect()
                                                    ->route('getPayment')
                                                    ->with('success', "Payment was successful but money is not
                                                    donated Hint: set the school donation percentage!");
                                            }
                                        }
                                    }
                                    if ($request->has('i_m_staff')
                                        && strlen(trim($request->input('i_m_staff')))) {
                                        return redirect()
                                            ->route('getMakePayments')
                                            ->with('success', "Payment was successful!");
                                    } else {
                                        return redirect()
                                            ->route('getPayment')
                                            ->with('success', "Payment was successful!");
                                    }
                                } else {
                                    if ($request->has('i_m_staff')
                                        && strlen(trim($request->input('i_m_staff')))) {
                                        return redirect()
                                            ->route('getMakePayments')
                                            ->with('fail', "Payment Failed check card details & try again later!");
                                    } else {
                                        return redirect()
                                            ->route('getPayment')
                                            ->with('fail', "Payment Failed check card details & try again later!");
                                    }
                                }
                            } else {
                                return redirect()
                                    ->back()
                                    ->with('fail', "Customer's card details not found.");
                            }
                        } else {
                            return redirect()
                                ->back()
                                ->with('fail', "Invalid order to charge.");
                        }
                    } else {
                        return redirect()
                            ->back()
                            ->with('fail', "Invalid order to charge.");
                    }
                } else {
                    return redirect()
                        ->back()
                        ->with('fail', "Your payment account is in 'Test' mode. Please make sure to set 'Live' API keys 
                        on 'Live' mode to charge a card and also change to 'Live' mode in your Stripe dashboard.");
                }
            } else {
                return redirect()
                    ->back()
                    ->with('fail', "Please setup your payment account info before charging a card.");
            }
        } else {
            if ($request->has('i_m_staff') && strlen(trim($request->input('i_m_staff')))) {
                return redirect()
                    ->route('getMakePayments')
                    ->with('fail', "Wrong date format! Date format should be YYYY-MM.");
            } else {
                return redirect()
                    ->route('getPayment')
                    ->with('fail', "Wrong date format! Date format should be YYYY-MM.");
            }
        }
    }

    public function postPaymentKeys(Request $request) {
    	//dd($request->i_m_staff);
    	$payment_keys = PaymentKeys::first();
    	if ($payment_keys != null) {
    		$payment_keys->login_id = trim($request->authorize_id);
    		$payment_keys->transaction_key = trim($request->tran_key);
	    	$payment_keys->mode = $request->mode;
	    	if ($payment_keys->save()) {
	    		if (isset($request->i_m_staff)) {
	    			return redirect()->route('getMakePayments')->with('success', "Account Details Successfully Saved!");
	    		}
	    		else
	    		{
	    			return redirect()->route('getPayment')->with('success', "Account Details Successfully Saved!");
	    		}
	    	}
	    	else
	    	{
	    		if (isset($request->i_m_staff)) {
	    			return redirect()->route('getMakePayments')->with('fail', "Failed to save details");
	    		}
	    		else
	    		{
	    			return redirect()->route('getPayment')->with('fail', "Failed to save details");
	    		}
	    	}
    	}
    	else
    	{
    		$save_details = new PaymentKeys();
	    	$save_details->login_id = trim($request->authorize_id);
	    	$save_details->transaction_key = trim($request->tran_key);
	    	$save_details->mode = $request->mode;
	    	if ($save_details->save()) {
	    		return redirect()->route('getPayment')->with('success', "Account Details Successfully Saved!");
	    	}
	    	else
	    	{
	    		return redirect()->route('getPayment')->with('fail', "Failed to save details");
	    	}
    	}
    }
    public function postMarkAsPaid(Request $request) {
    	//return $request;
    	$search_req = Pickupreq::find($request->pick_up_req_id);
    	//return $search_req;
    	if ($search_req) {
    		$search_req->payment_status = 1;
    		if ($search_req->save()) {
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
    public function getManageClientPayment() {
    	$obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $data = Pickupreq::where('payment_type', '!=', 1)->with('user')->paginate(10);
        //dd($data);
        return view('admin.pending-payments', compact('user_data', 'site_details', 'data'));
    }
}
   
