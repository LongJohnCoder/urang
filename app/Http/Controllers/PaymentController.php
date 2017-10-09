<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Helper\NavBarHelper;
use App\PaymentKeys;
use App\Pickupreq;
use App\CustomerCreditCardInfo;
use App\Invoice;
use App\SchoolDonations;
use App\SchoolDonationPercentage;
use Stripe\Charge;
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

    public function AuthoRizePayment(Request $auth_request) {
    	//dd($auth_request);
    	if(preg_match('/^([0-9]{4})-([0-9]{2})$/', $auth_request->exp_date)) {
    		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
	   		$payment_keys = PaymentKeys::first();
	   		//dd($payment_keys);
	   		if ($payment_keys != null) {
	   			$merchantAuthentication->setName($payment_keys->login_id);
				$merchantAuthentication->setTransactionKey($payment_keys->transaction_key);
				// Create the payment data for a credit card
				$creditCard = new AnetAPI\CreditCardType();
				$creditCard->setCardNumber($auth_request->card_no);
				$creditCard->setExpirationDate($auth_request->exp_date);
				//$creditCard->setCardCode($auth_request->cvv);
				$paymentOne = new AnetAPI\PaymentType();
				$paymentOne->setCreditCard($creditCard);
				// Create a transaction
				$transactionRequestType = new AnetAPI\TransactionRequestType();
				$transactionRequestType->setTransactionType("authCaptureTransaction");
				$transactionRequestType->setAmount($auth_request->amount);
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
				//$re1 = json_decode($response->getTransactionResponse());
				//dd($response->getTransactionResponse());
				if ($response != null)
				{
					//dd($response);
				    $tresponse = $response->getTransactionResponse();
				    if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )
				    {
				    	//dd($tresponse);
				    	//marking as paid
				    	if ($auth_request->pick_up_re_id != null) {
				    		$search_pickup_req = Pickupreq::find($auth_request->pick_up_re_id);
						    $search_pickup_req->payment_status = 1;
						    $search_pickup_req->order_status = 4;
						    $search_pickup_req->save();
				    	}
					    if ($auth_request->school_donation_id != null) {
					    	//donate to school
					    	 //get the percenatge
					    	$percentage = SchoolDonationPercentage::first();
					    	if ($percentage != null) {
					    		$fetch_school = SchoolDonations::find($auth_request->school_donation_id);
					    		if ($fetch_school) {
					    			$fetch_school->actual_pending_money += ($auth_request->amount*$percentage->percentage)/100;
					    			if ($fetch_school->save()) {
					    				if (isset($auth_request->i_m_staff)) {
					    					return redirect()->route('getMakePayments')->with('success', "Payment was successfull!");
					    				}
					    				else {
								    		return redirect()->route('getPayment')->with('success', "Payment was successfull!");
								    	}
					    			}
					    			else
					    			{
					    				if (isset($auth_request->i_m_staff)) {
					    					return redirect()->route('getMakePayments')->with('success', "Payment was successfull but cannot donate to the school. Hint: error while saving data!");
					    				}
					    				else {
								    		return redirect()->route('getPayment')->with('success', "Payment was successfull but cannot donate to the school. Hint: error while saving data!");
								    	}
					    				//return redirect()->route('getMakePayments')->with('success', "Payment was successfull but cannot donate to the school. Hint: error while saving data!");
					    			}
					    		}
					    		else
					    		{
					    			//return to avoid the error
					    			if (isset($auth_request->i_m_staff)) {
				    					return redirect()->route('getMakePayments')->with('success', "Payment was successfull but cannot donate to the requested school. Hint: could not locate it!");
				    				}
				    				else {
							    		return redirect()->route('getPayment')->with('success', "Payment was successfull but cannot donate to the requested school. Hint: could not locate it!");
							    	}
					    			//return redirect()->route('getMakePayments')->with('success', "Payment was successfull but cannot donate to the requested school. Hint: could not locate it!");
					    		}
					    	}
					    	else
					    	{
					    		if (isset($auth_request->i_m_staff)) {
			    					return redirect()->route('getMakePayments')->with('success', "Payment was successfull but money is not donated Hint: set the school donation percentage!");
			    				}
			    				else {
						    		return redirect()->route('getPayment')->with('success', "Payment was successfull but money is not donated Hint: set the school donation percentage!");
						    	}
					    		//return to avoid error
					    		//return redirect()->route('getMakePayments')->with('success', "Payment was successfull but money is not donated Hint: set the school donation percentage!");
					    	}
					    }
				    	if (isset($auth_request->i_m_staff)) {
				    		return redirect()->route('getMakePayments')->with('success', "Payment was successfull!");
				    	} else {
				    		return redirect()->route('getPayment')->with('success', "Payment was successfull!");
				    	}
				    }
				    else
				    {
				    	//dd($response);
				    	if (isset($auth_request->i_m_staff)) {
				    		return redirect()->route('getMakePayments')->with('fail', "Payment Failed check card details and try again later!");
				    	} else {
				    		return redirect()->route('getPayment')->with('fail', "Payment Failed check card details and try again later!");
				    	}
				    }
				}
				else
				{
					//dd($response);
				    if (isset($auth_request->i_m_staff)) {
			    		return redirect()->route('getMakePayments')->with('fail', "Payment Failed check card details and try again later!");
			    	} else {
			    		return redirect()->route('getPayment')->with('fail', "Payment Failed check card details and try again later!");
			    	}
				}
	   		}
	   		else
	   		{
	   			if (isset($auth_request->i_m_staff)) {
		    		return redirect()->route('getMakePayments')->with('fail', "Payment Failed check card details and try again later!");
		    	} else {
		    		return redirect()->route('getPayment')->with('fail', "Payment Failed check card details and try again later!");
		    	}
	   		}
    	}
		else
		{
			if (isset($auth_request->i_m_staff)) {
	    		return redirect()->route('getMakePayments')->with('fail', "Wrong date format! Date format should be YYYY-MM.");
	    	} else {
	    		return redirect()->route('getPayment')->with('fail', "Wrong date format! Date format should be YYYY-MM.");
	    	}
		}

    }

    public function chargePayment(Request $request)
    {
        if(preg_match('/^([0-9]{4})-([0-9]{2})$/', $request->input('exp_date'))) {
            $paymentKey = PaymentKeys::first();
            if ($paymentKey) {
                if (!$paymentKey->mode) {
                    if ($request->has('pick_up_re_id') && strlen(trim($request->input('pick_up_re_id')))) {
                        $pickUpRequest = Pickupreq::whereId($request->input('pick_up_re_id'))
                            ->wherePaymentStatus(0)
                            ->first();
                        if ($pickUpRequest) {
                            $customer = CustomerCreditCardInfo::whereUserId($pickUpRequest->user_id)->first();
                            if (strlen(trim($customer->stripe_customer_id))) {
                                Stripe::setApiKey($paymentKey->transaction_key);

                                $charge = Charge::create([
                                    "amount" => $request->has('amount') ? $request->input('amount') * 100 : 0,
                                    "currency" => "usd",
                                    "customer" => $customer->stripe_customer_id
                                ]);

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
                                                            ->with('success', "Payment was successful but cannot donate
                                                             to the school. Hint: error while saving data!");
                                                    } else {
                                                        return redirect()
                                                            ->route('getPayment')
                                                            ->with('success', "Payment was successful but cannot donate
                                                             to the school. Hint: error while saving data!");
                                                    }
                                                }
                                            } else {
                                                if ($request->has('i_m_staff')
                                                    && strlen(trim($request->input('i_m_staff')))) {
                                                    return redirect()
                                                        ->route('getMakePayments')
                                                        ->with('success', "Payment was successful but cannot donate to 
                                                        the requested school. Hint: could not locate it!");
                                                } else {
                                                    return redirect()
                                                        ->route('getPayment')
                                                        ->with('success', "Payment was successful but cannot donate to 
                                                        the requested school. Hint: could not locate it!");
                                                }
                                            }
                                        } else {
                                            if ($request->has('i_m_staff')
                                                && strlen(trim($request->input('i_m_staff')))) {
                                                return redirect()
                                                    ->route('getMakePayments')
                                                    ->with('success', "Payment was successful but money is not donated 
                                                    Hint: set the school donation percentage!");
                                            } else {
                                                return redirect()
                                                    ->route('getPayment')
                                                    ->with('success', "Payment was successful but money is not donated 
                                                    Hint: set the school donation percentage!");
                                            }
                                        }
                                    }
                                    if ($request->has('i_m_staff') && strlen(trim($request->input('i_m_staff')))) {
                                        return redirect()
                                            ->route('getMakePayments')
                                            ->with('success', "Payment was successful!");
                                    } else {
                                        return redirect()
                                            ->route('getPayment')
                                            ->with('success', "Payment was successful!");
                                    }
                                } else {
                                    if ($request->has('i_m_staff') && strlen(trim($request->input('i_m_staff')))) {
                                        return redirect()
                                            ->route('getMakePayments')
                                            ->with('fail', "Payment Failed check card details and try again later!");
                                    } else {
                                        return redirect()
                                            ->route('getPayment')
                                            ->with('fail', "Payment Failed check card details and try again later!");
                                    }
                                }
                            } else {
                                return redirect()
                                    ->back()
                                    ->with('fail', "Invalid customer.");
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
   
