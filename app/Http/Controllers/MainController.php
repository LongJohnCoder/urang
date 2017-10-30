<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Cms;
use App\Coupon;
use App\CustomerCreditCardInfo;
use App\Events\PickUpReqEvent;
use App\Events\ResetPassword;
use App\Events\SendCustomerComplaints;
use App\Events\SendEmailOnSignUp;
use App\Faq;
use App\Helper\NavBarHelper;
use App\Helper\SiteHelper;
use App\IndexContent;
use App\IndexPageWysiwyg;
use App\Invoice;
use App\MobileAppWys;
use App\Neighborhood;
use App\OrderDetails;
use App\OrderTracker;
use App\PaymentKeys;
use App\Pickupreq;
use App\PickUpTime;
use App\PushNotification;
use App\ref;
use App\SchoolDonationPercentage;
use App\SchoolDonations;
use App\SchoolPreferences;
use App\User;
use App\UserDetails;
use Auth;
use Event;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class MainController extends Controller
{

    public function __construct()
    {
        /*if (auth()->guard('users')->user()) {
            $isBlocked = auth()->guard('users')->user()->block_status;
            if ($isBlocked == 1) {
                $user = auth()->guard('users');
                $user->logout();
            }
        }
        else
        {
            //dd('hete');
            return redirect()->route('getLogin');
        }*/
        /*if ($flag == true) {
            return redirect()->route('getLogin');
            $flag = false;
        }*/
    }

    public function getIndex()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $cms = IndexContent::first();
        $indexcontent = IndexPageWysiwyg::first();
        return view('pages.index', compact('site_details', 'cms', 'indexcontent'));
    }

    public function getLogin()
    {
        $user = auth()->guard('users');
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$neighborhood = $obj->getNeighborhood();
        if ($user->user()) {
            //return view('pages.userdashboard', compact('site_details'));
            return redirect()->route('getCustomerDahsboard');
        } else {
            return view('pages.login', compact('site_details'));
        }
    }
    //check for session for back button
    /*public function checkForSessioUser(Request $request) {
        if (auth()->guard('users')->user()) {
            return 1;
        }
        else
        {
            return 0;
        }
    }*/
    public function getSignUp()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$neighborhood = $obj->getNeighborhood();
        return view('pages.signup', compact('site_details'));
    }

    public function postSignUp(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'conf_password' => 'required|min:6|same:password',
            'name' => 'required',
            'strt_address_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'personal_phone' => 'required',
            'cardholder_name' => 'required',
            'card_no' => 'required',
            'select_month' => 'required',
            'select_year' => 'required'
        ]);
        if ($request->password == $request->conf_password) {
            $user = new User();
            $user->email = $request->email;
            //search for email refer table
            /*$is_ref = ref::where('referred_person', $request->email)->first();
            if ($is_ref != null) {
                $is_ref->discount_status = 1;
                $is_ref->save();
            }*/
            $user->password = bcrypt($request->password);
            $user->is_eligible_for_sign_up_discount = 1;
            $user->block_status = 0;
            if ($user->save()) {
                $user_details = new UserDetails();
                $user_details->user_id = $user->id;
                $user_details->name = $request->name;
                $user_details->address_line_1 = $request->strt_address_1;
                $user_details->address_line_2 = $request->strt_address_2;
                $user_details->personal_ph = $request->personal_phone;
                $user_details->cell_phone = isset($request->cell_phone) ? $request->cell_phone : NULL;
                $user_details->off_phone = isset($request->office_phone) ? $request->office_phone : NULL;
                $user_details->spcl_instructions = isset($request->spcl_instruction) ? $request->spcl_instruction : NULL;
                $user_details->driving_instructions = isset($request->driving_instruction) ? $request->driving_instruction : NULL;
                $user_details->city = $request->city;
                $user_details->state = $request->state;
                $user_details->zip = $request->zip;
                if ($user_details->save()) {

                    //referrel
                    if ($request->ref_name != null) {
                        $search_email = User::where('email', $request->ref_name)->first();
                        if ($search_email) {
                            return redirect()->route('getSignUp')->with('fail', 'referel email already exist .Please try another one')->withInput();
                        } else {
                            $search_in_refs = ref::where('referred_person', $request->ref_name)->first();
                            if ($search_in_refs) {
                                return redirect()->route('getSignUp')->with('fail', 'referel email already exist .Please try another one')->withInput();
                            } else {
                                if (filter_var($request->ref_name, FILTER_VALIDATE_EMAIL)) {
                                    $user_details->referred_by = $request->ref_name;
                                    //storing into ref table for future reference
                                    $ref = new ref();
                                    $ref->user_id = $user->id;
                                    $ref->referred_person = $request->ref_name;
                                    $ref->referral_email = $request->email;
                                    $ref->discount_status = 0; //this should be 1 to get the discount
                                    $ref->is_expired = 0; //this will be 1 as soon as user will get the discount.
                                    $ref->save();
                                } else {
                                    $user_details->delete();
                                    $user->delete();
                                    return redirect()->route('getSignUp')->with('fail', 'Referral type should be type of email. Please paste an email of the person you want to refer')->withInput();
                                }
                            }

                        }
                    }

                    /*
                     * Pre Auth Card using $1 (unsettled or uncpatured amount)
                     */
                    $paymentKey = PaymentKeys::first();
                    if ($paymentKey) {
                        Stripe::setApiKey($paymentKey->transaction_key); // Stripe Secret API Key

                        $source = [
                            'object' => 'card',
                            'number' => str_replace(' ', '', $request->input('card_no')),
                            'exp_month' => $request->input('select_month'),
                            'exp_year' => $request->input('select_year'),
                            'cvc' => $request->has('cvv') && strlen(trim($request->input('cvv'))) ?
                                $request->input('cvv') : null,
                        ];

                        $charge = Charge::create([
                            "amount" => 100,    // 100 Cent = $1
                            "currency" => "usd",
                            "description" => "$1 Pre-authorization",
                            "capture" => false,
                            "source" => $source
                        ]);

                        $customer = null;
                        if ($charge) {
                            $customer = Customer::create([
                                "email" => $request->input('email'),
                                "source" => $source
                            ]);

                            $card_info = new CustomerCreditCardInfo();
                            $card_info->user_id = $user_details->user_id;
                            $card_info->name = $request->input('cardholder_name');
                            $card_info->card_no = $source['number'];
                            $card_info->cvv = $source['cvc'];
                            $card_info->exp_month = $source['exp_month'];
                            $card_info->exp_year = $source['exp_year'];
                            $card_info->card_id = array_key_exists(0, $customer->sources->data) ?
                                $customer->sources->data[0]->id : null;
                            $card_info->card_type = array_key_exists(0, $customer->sources->data) ?
                                $customer->sources->data[0]->brand : null;
                            $card_info->card_fingerprint = array_key_exists(0, $customer->sources->data) ?
                                $customer->sources->data[0]->fingerprint : null;
                            $card_info->card_country = array_key_exists(0, $customer->sources->data) ?
                                $customer->sources->data[0]->country : null;
                            $card_info->stripe_customer_id = $customer->id;

                            if ($card_info->save()) {
                                /*
                                 * confirmation mail event driven approach
                                 */
                                Event::fire(new SendEmailOnSignUp($request));

                                return redirect()
                                    ->route('getLogin')
                                    ->with('success', 'You have successfully registered please login');
                            } else {
                                return redirect()
                                    ->route('getSignUp')
                                    ->with('fail', 'Cannot save your card details');
                            }
                        } else {
                            return redirect()
                                ->route('getSignUp')
                                ->with('fail', 'We are getting trouble to validate your card. 
                                Please use an different card.');
                        }
                    }
                } else {
                    return redirect()->route('getSignUp')->with('fail', 'Cannot save your user details');
                }
            } else {
                return redirect()->route('getSignUp')->with('fail', 'Cannot save your user details');
            }
        } else {
            return redirect()->route('getSignUp')->with('fail', 'Password and confirm password did not match');
        }
    }

    public function getForgotPassword()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.forgot-password', compact('site_details'));
    }

    public function postForgotPassword(Request $request)
    {
        $search_user = User::where('email', $request->forgot_pass_user_email)->with('user_details')->first();
        if ($search_user != null && $search_user->block_status == 0) {
            //dd(base64_encode($search_user->id));
            Event::fire(new ResetPassword($search_user));
            return redirect()->route('getForgotPassword')->with('success', "password reset email has been sent to your email. Did not receive one? try again after 1 min.");
        } else {
            return redirect()->route('getForgotPassword')->with('fail', "Could not find user of this email or make sure you are not blocked");
        }
    }

    public function getResetUserPassword($id)
    {
        $reset_id = base64_decode($id);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.reset-password', compact('reset_id'));
    }

    public function postResetPassword(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'conf_new_password' => 'required|min:6|same:new_password',
            'user_id' => 'required',
        ]);
        $user = User::find($request->user_id);
        if ($user) {
            $user->password = bcrypt($request->conf_new_password);
            if ($user->save()) {
                return redirect()->route('getLogin')->with('success', "Successfully reset password. you can login now!");
            } else {
                return redirect()->route('getLogin')->with('fail', "Error in saving new password please try again later!");
            }
        } else {
            return redirect()->route('getLogin')->with('fail', 'Cannot reset your password try to create a new account!');
        }
    }

    public function postCustomerLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember) ? true : false;
        $user = auth()->guard('users');
        $block_status = User::where('email', $email)->first();
        if ($block_status != null) {
            if ($block_status->block_status == 0) {
                if ($user->attempt(['email' => $email, 'password' => $password], $remember_me)) {
                    return redirect()->route('getCustomerDahsboard');
                } else {
                    return redirect()->route('getLogin')->with('fail', 'Wrong Username or Password');
                }
            } else {
                return redirect()->route('getLogin')->with('fail', 'Sorry you are blocked by the system admin!');
            }
        } else {
            return redirect()->route('getLogin')->with('fail', 'Sorry! you have entered a wrong username');
        }
    }

    public function getDashboard()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        $pick_up_req = Pickupreq::where('user_id', $logged_user->id)->get();
        return view('pages.userdashboard', compact('site_details', 'logged_user', 'pick_up_req'));
    }

    public function getLogout()
    {
        $user = auth()->guard('users');
        $user->logout();
        return redirect()->route('getLogin');
    }

    public function getProfile()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        $school_list = SchoolDonations::all();
        //dd($logged_user->user_details->toArray());
        //$neighborhood = $obj->getNeighborhood();
        return view('pages.profile', compact('site_details', 'logged_user', 'school_list'));
    }

    public function postProfile(Request $request)
    {
        $obj = new NavBarHelper();
        $logged_user = $obj->getCustomerData();
        $update_id = $logged_user->id;
        $user = User::find($update_id);
        $user->email = $request->email;
        if ($user->save()) {
            $user_details = UserDetails::where('user_id', $update_id)->first();
            $user_details->user_id = $update_id;
            $user_details->name = $request->name;
            $user_details->address_line_1 = $request->address_line_1;
            $user_details->address_line_2 = isset($request->address_line_2) && $request->address_line_2 != null ? $request->address_line_2 : $user_details->address_line_2;
            $user_details->personal_ph = $request->personal_phone;
            $user_details->cell_phone = $request->cell_phone != null ? $request->cell_phone : '';
            $user_details->off_phone = $request->office_phone != null ? $request->office_phone : '';
            $user_details->spcl_instructions = $request->spcl_instruction != null ? $request->spcl_instruction : '';
            $user_details->driving_instructions = $request->driving_instruction != null ? $request->driving_instruction : '';
            $user_details->school_id = $request->school_donation_id;
            $user_details->city = $request->city;
            $user_details->state = $request->state;
            $user_details->zip = $request->zip;
            if ($user_details->save()) {
                $paymentKey = PaymentKeys::first();
                if ($paymentKey) {
                    Stripe::setApiKey($paymentKey->transaction_key); // Stripe Secret API Key
                    $card_info = CustomerCreditCardInfo::where('user_id', $update_id)->first();

                    $source = [
                        'object' => 'card',
                        'number' => $request->card_no,
                        'exp_month' => $request->select_month,
                        'exp_year' => $request->select_year,
                        'cvc' => $request->cvv,
                    ];

                    try {
                        $charge = Charge::create([
                            "amount" => 100,    // 100 Cent = $1
                            "currency" => "usd",
                            "description" => "$1 Pre-authorization",
                            "capture" => false,
                            "source" => $source
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

                    $stripeCustomer = null;
                    if ($charge) {
                        $error = null;
                        try {
                            if ($card_info) {
                                $stripeCustomer = Customer::retrieve($card_info->stripe_customer_id);
                                $oldCard = $stripeCustomer->sources->retrieve($card_info->card_id);
                                $oldCard->delete();
                                $newCard = $stripeCustomer->sources->create(["source" => $source]);
                                $stripeCustomer->default_source = $newCard->id;
                                $stripeCustomer->save();
                            } else {
                                $card_info = new CustomerCreditCardInfo();
                                $stripeCustomer = Customer::create([
                                    "email" => $user->email,
                                    "source" => $source
                                ]);
                            }
                        } catch (\Stripe\Error\RateLimit $e) {
                            $error = $e->getMessage();
                        } catch (\Stripe\Error\InvalidRequestError $e) {
                            $error = $e->getMessage();
                        } catch (\Stripe\Error\AuthenticationError $e) {
                            $error = $e->getMessage();
                        } catch (\Stripe\Error\ApiConnectionError $e) {
                            $error = $e->getMessage();
                        } catch (\Stripe\Error\Error $e) {
                            $error = $e->getMessage();
                        } catch (\Exception $e) {
                            $error = $e->getMessage();
                        }

                        if (gettype($error) === 'string' && strlen(trim($error)) > 0) {
                            if (preg_match('/No such customer:/', $error)) {
                                try {
                                    $stripeCustomer = Customer::create([
                                        "email" => $user->email,
                                        "source" => $source
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
                            } else {
                                return redirect()->back()->with('fail', $error);
                            }
                        }

                        $card_info->user_id = $update_id;
                        $card_info->name = $request->cardholder_name;
                        $card_info->card_no = $request->card_no;
                        $card_info->card_type = $request->cardtype;
                        $card_info->cvv = $request->cvv;
                        $card_info->exp_month = $request->select_month;
                        $card_info->exp_year = $request->select_year;
                        $card_info->card_id = array_key_exists(0, $stripeCustomer->sources->data) ?
                                $stripeCustomer->sources->data[0]->id : null;
                        $card_info->card_fingerprint = array_key_exists(0, $stripeCustomer->sources->data) ?
                                    $stripeCustomer->sources->data[0]->fingerprint : null;
                        $card_info->card_country =
                                array_key_exists(0, $stripeCustomer->sources->data) ?
                                    $stripeCustomer->sources->data[0]->country : null;
                        $card_info->stripe_customer_id = $stripeCustomer->id;

                        if ($card_info->save()) {
                            return redirect()->route('get-user-profile')->with('success', 'Details successfully updated!');
                        } else {
                            return redirect()->route('get-user-profile')->with('fail', 'Could not save your card details!');
                        }
                    } else {
                        return redirect()->route('get-user-profile')->with('fail', 'Invalid card, please use a valid card!');
                    }
                } else {
                    return redirect()
                        ->back()
                        ->with('fail', "Oops! Something went wrong. Please contact to <a href='mailto:lisa@u-rang.com?subject=Update%20Card%20Error&body=Possible%20reason%20payment%20gateway%20error.'>lisa@u-rang.com</a> now.");
                }
            } else {
                return redirect()->route('get-user-profile')->with('fail', 'Could not save user details!');
            }
        } else {
            return redirect()->route('get-user-profile')->with('fail', 'Could not save user details!');
        }
    }

    public function getChangePassword()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        //$neighborhood = $obj->getNeighborhood();
        return view('pages.changepassword', compact('site_details', 'logged_user'));
    }

    public function postChangePassword(Request $request)
    {
        //dd($request);
        if ($request->new_password == $request->conf_password) {
            $id = auth()->guard('users')->user()->id;
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $user = User::find($id);
            if (Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
                if ($user->save()) {
                    return redirect()->route('getChangePassword')->with('success', "Password updated successfully!");
                } else {
                    return redirect()->route('getChangePassword')->with('fail', "Can't update your password right now please try again later");
                }
            } else {
                return redirect()->route('getChangePassword')->with('fail', 'old password did not match with our record');
            }
        } else {
            return redirect()->route('getChangePassword')->with('fail', 'Password and confirm password did not match!');
        }
    }

    public function getPrices()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        //$neighborhood = $obj->getNeighborhood();
        //dd($login_check);
        $price_list = Categories::with('pricelists')->get();
        //dd($price_list);
        if ($login_check != null) {
            //dd('i m here');
            $logged_user = $obj->getCustomerData();
            return view('pages.price', compact('site_details', 'login_check', 'logged_user', 'price_list'));
        } else {
            return view('pages.price', compact('site_details', 'login_check', 'price_list'));
        }

    }

    public function getNeiborhoodPage()
    {
        //dd(1);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.neighborhood', compact('site_details', 'login_check', 'price_list', 'logged_user', 'neighborhood'));
        } else {
            return view('pages.neighborhood', compact('site_details', 'login_check', 'price_list', 'neighborhood'));
        }
    }

    public function getFaqList()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        //$neighborhood = $obj->getNeighborhood();
        $faq = Faq::all();
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.faquser', compact('site_details', 'login_check', 'price_list', 'logged_user', 'faq'));
        } else {
            return view('pages.faquser', compact('site_details', 'login_check', 'price_list', 'faq'));
        }
    }

    public function emailChecker(Request $request)
    {
        //return $request->email;
        $email = $request->email;
        $find_email = User::where('email', $email)->first();
        //return $find_email;
        if ($find_email != null) {
            return 0;
        } else {
            return 1;
        }
    }

    public function emailReferalChecker(Request $request)
    {
        //return $request->email;
        $email = $request->email;
        $find_email = User::where('email', $email)->first();
        //return $find_email;
        if ($find_email != null) {
            return 0;
        } else {
            $ref = ref::where('referred_person', $email)->first();
            if ($ref != null) {
                return 1;
            } else {
                return 2;
            }

        }
    }

    public function postEmailCheckerRef(Request $request)
    {
        $email = $request->email;
        $find_email = User::where('email', $email)->first();
        if ($find_email != null) {
            return 0;
        } else {
            $search_email_ref = ref::where('referred_person', $email)->first();
            if ($search_email_ref != null) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function getContactUs()
    {

        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.contact', compact('site_details', 'login_check', 'logged_user'));
        } else {
            return view('pages.contact', compact('site_details', 'login_check'));
        }
    }

    public function postContactForm(Request $request)
    {
        //dd($request->message);
        $firstname = $request->firstName;
        $lastname = $request->lastName;
        $email = $request->email;
        $subject = $request->subject;
        $text = $request->message;
        //dd($message);
        $phone = $request->phone;

        Mail::send('pages.sendEmailContact', ['firstName' => $firstname, 'lastName' => $lastname, 'email' => $email, 'subject' => $subject, 'text' => $text, 'phone' => $phone], function ($msg) use ($request) {
            $msg->from($request->email, 'U-rang');
            $msg->to(\App\Helper\ConstantsHelper::getClintEmail(), $request->firstName)->subject('U-rang Details');
            $msg->bcc(\App\Helper\ConstantsHelper::getBccEmail(), $request->firstName);
        });

        return redirect()->route('getContactUs')->with('success', 'Thank you for contacting us, We will get back to you shortly');
    }

    public function getPickUpReq()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.pickupreq', compact('site_details'));
    }

    //================================================================
    public function SayMeTheDate($pick_up_date, $created_at)
    {
        //dd($pick_up_date);
        $date = $pick_up_date;
        $time = $created_at->toTimeString();
        $data = $this->returnData(date('l', strtotime($date)));
        if ($data != "E500" && $data != null) {
            if ($data->closedOrNot != 1) {

                if (strtotime($data->opening_time) <= strtotime($time) && strtotime($data->closing_time) >= strtotime($time)) {
                    $show_expected = "pick up day " . date('F j , Y', strtotime($date)) . "\n" . "before " . date("h:i a", strtotime($data->closing_time));
                    return $show_expected;
                } else if (strtotime($data->closing_time) < strtotime($time)) {
                    $new_date = date('Y-m-d', strtotime($date) + 86400);
                    return $this->SayMeTheDate($new_date, $created_at);
                } else if (strtotime($data->opening_time) > strtotime($time)) {
                    $new_date = date('Y-m-d', strtotime($date) - 86400);
                    return $this->SayMeTheDate($new_date, $created_at);
                } else {
                    $show_expected = "Can't tell you real expected time admin might not set it up yet";
                    return $show_expected;
                }
            } else {
                $new_pickup_date = date('Y-m-d', strtotime($date) + 86400);
                return $this->SayMeTheDate($new_pickup_date, $created_at);
            }
        } else {
            return "";
        }
    }

    private function returnData($day)
    {
        switch ($day) {
            case 'Monday':
                return PickUpTime::where('day', 1)->first();
                break;
            case 'Tuesday':
                return PickUpTime::where('day', 2)->first();
                break;
            case 'Wednesday':
                return PickUpTime::where('day', 3)->first();
                break;
            case 'Thursday':
                return PickUpTime::where('day', 4)->first();
                break;
            case 'Friday':
                return PickUpTime::where('day', 5)->first();
                break;
            case 'Saturday':
                return PickUpTime::where('day', 6)->first();
                break;
            case 'Sunday':
                return PickUpTime::where('day', 7)->first();
                break;
            default:
                return "E500";
                break;
        }
    }

    public function checkIfReferalInsertedAdmin($request)
    {
        $user_data = User::find($request->user_id);

        if ($user_data) {
            if ($request->email_checker_referal != 0) {
                $ref = new ref();
                $ref->user_id = $request->user_id;
                $ref->referred_person = $request->emailReferal;
                $ref->referral_email = $user_data->email;
                $ref->discount_status = 0; //this should be 1 to get the discount
                $ref->is_expired = 0; //this will be 1 as soon as user will get the discount.
                $ref->save();
            }

            //if(!is_null(auth()->guard('users')->user()) && !is_null(auth()->guard('users')->user()->email)) {
            //auth()->guard('users')->user()->email
            //dd($user_data);
            if (!is_null($user_data->email)) {
                $is_ref = ref::where('referred_person', $user_data->email)->where('is_expired', 0)->where('is_referal_done', 0)->first();
                if ($is_ref != null) {
                    $is_ref->discount_status = 1;
                    $is_ref->is_referal_done = 1;
                    $is_ref->save();
                }
            }


            //}
        }

    }

    public function checkIfReferalInserted($request)
    {
        //dd($request);
        if ($request->email_checker_referal != 0) {
            $ref = new ref();
            $ref->user_id = auth()->guard('users')->user()->id;
            $ref->referred_person = $request->emailReferal;
            $ref->referral_email = auth()->guard('users')->user()->email;
            $ref->discount_status = 0; //this should be 1 to get the discount
            $ref->is_expired = 0; //this will be 1 as soon as user will get the discount.
            $ref->save();
        }

        $is_ref = ref::where('referred_person', auth()->guard('users')->user()->email)->where('is_expired', 0)->where('is_referal_done', 0)->first();
        if ($is_ref != null) {
            $is_ref->discount_status = 1;
            $is_ref->is_referal_done = 1;
            $is_ref->save();
        }

    }

    public function postPickUp(Request $request)
    {
        if ($request->time_frame_start != null && $request->time_frame_end != null) {
            $start_time = strtotime($request->time_frame_start);
            $end_time = strtotime($request->time_frame_end);
            if ($start_time < $end_time) {
                //$this->checkIfReferalInserted($request);
                return $this->postMyPickup($request);
            } else if ($start_time > $end_time) {
                if ($request->identifier == "admin") {
                    return redirect()->route('getPickUpReqAdmin')->with('fail', "start time could not be greater than end time!");
                } else {
                    return redirect()->route('getPickUpReq')->with('fail', "start time could not be greater than end time!");
                }

            } else {
                if ($request->identifier == "admin") {
                    return redirect()->route('getPickUpReqAdmin')->with('fail', "Wrong input in time frame. Hint: start time could not be greater than or equals to endtime!");
                } else {
                    return redirect()->route('getPickUpReq')->with('fail', "Wrong input in time frame. Hint: start time could not be greater than or equals to endtime!");
                }
            }
        } else {
            $paymentKey = PaymentKeys::first();
            if ($paymentKey) {
                $customer = CustomerCreditCardInfo::whereUserId(auth()->guard('users')->user()->id)->first();
                if ($customer) {
                    Stripe::setApiKey($paymentKey->transaction_key); // Stripe Secret API Key

                    /*
                     * If a customer has Stripe customer ID then,
                     *      that customer is already been pre-authorized and schedule the pickup
                     * else
                     *      pre-authorized that customer's card for $1 and save Stripe customer ID into dB
                     *      then schedule the pickup.
                     */
                    if (strlen(trim($customer->stripe_customer_id))) {
                        return $this->postMyPickup($request);
                    } else {
                        $source = [
                            'object' => 'card',
                            'number' => $customer->card_no,
                            'exp_month' => $customer->exp_month,
                            'exp_year' => $customer->exp_year,
                            'cvc' => $customer->cvv,
                        ];

                        $charge = Charge::create([
                            "amount" => 100,    // 100 Cent = $1
                            "currency" => "usd",
                            "description" => "$1 Pre-authorization",
                            "capture" => false,
                            "source" => $source
                        ]);

                        $stripeCustomer = null;
                        if ($charge) {
                            $stripeCustomer = Customer::create([
                                "email" => auth()->guard('users')->user()->email,
                                "source" => $source
                            ]);

                            /*
                             * Save Stripe customer ID and other card details into dB.
                             */
                            $customer->card_id = array_key_exists(0, $stripeCustomer->sources->data) ?
                                $stripeCustomer->sources->data[0]->id : null;
                            $customer->card_type = array_key_exists(0, $stripeCustomer->sources->data) ?
                                $stripeCustomer->sources->data[0]->brand : null;
                            $customer->card_fingerprint =
                                array_key_exists(0, $stripeCustomer->sources->data) ?
                                    $stripeCustomer->sources->data[0]->fingerprint : null;
                            $customer->card_country =
                                array_key_exists(0, $stripeCustomer->sources->data) ?
                                    $stripeCustomer->sources->data[0]->country : null;
                            $customer->stripe_customer_id = $stripeCustomer->id;
                            $customer->save();

                            return $this->postMyPickup($request);
                        } else {
                            return redirect()
                                ->route('getNewCreditCard')
                                ->with('fail', "We are getting trouble to validate your card. 
                                        Please use an different card.");
                        }
                    }
                } else {
                    return redirect()
                        ->route('getNewCreditCard')
                        ->with('fail', "Your saved card info is not found. Please re-enter your card info again.");
                }
            } else {
                return redirect()
                    ->back()
                    ->with('fail', "Oops! Something went wrong. Please contact to <a href='mailto: lisa@u-rang.com?subject=Pickup%20Request%20Error&body=Possible%20reason%20payment%20gateway%20error.'>lisa@u-rang.com</a> now.");
            }
        }
    }

    public function getNewCreditCard()
    {
        return view('pages.newcreditcard');
    }

    public function postNewCreditCard(Request $request)
    {
        $paymentKey = PaymentKeys::first();
        if ($paymentKey) {
            $customer = CustomerCreditCardInfo::whereUserId(auth()->guard('users')->user()->id)->first();
            if ($customer) {
                Stripe::setApiKey($paymentKey->transaction_key); // Stripe Secret API Key

                $source = [
                    'object' => 'card',
                    'number' => str_replace(' ', '', $request->input('card_no')),
                    'exp_month' => $request->input('select_month'),
                    'exp_year' => $request->input('select_year'),
                    'cvc' => $request->has('cvv') && strlen(trim($request->input('cvv')))
                        ? $request->input('cvv') : null,
                ];

                $charge = Charge::create([
                    "amount" => 100,    // 100 Cent = $1
                    "currency" => "usd",
                    "description" => "$1 Pre-authorization",
                    "capture" => false,
                    "source" => $source
                ]);

                $stripeCustomer = null;
                if ($charge) {
                    $stripeCustomer = Customer::create([
                        "email" => auth()->guard('users')->user()->email,
                        "source" => $source
                    ]);

                    /*
                     * Save Stripe customer ID and other card details into dB.
                     */
                    $customer->name = $request->input('cardholder_name');
                    $customer->card_no = $source['number'];
                    $customer->cvv = $source['cvc'];
                    $customer->exp_month = $source['exp_month'];
                    $customer->exp_year = $source['exp_year'];
                    $customer->card_id = array_key_exists(0, $stripeCustomer->sources->data) ?
                        $stripeCustomer->sources->data[0]->id : null;
                    $customer->card_type = array_key_exists(0, $stripeCustomer->sources->data) ?
                        $stripeCustomer->sources->data[0]->brand : null;
                    $customer->card_fingerprint =
                        array_key_exists(0, $stripeCustomer->sources->data) ?
                            $stripeCustomer->sources->data[0]->fingerprint : null;
                    $customer->card_country =
                        array_key_exists(0, $stripeCustomer->sources->data) ?
                            $stripeCustomer->sources->data[0]->country : null;
                    $customer->stripe_customer_id = $stripeCustomer->id;
                    $customer->save();

                    return redirect()
                        ->route('getPickUpReq')
                        ->with('success', "Please create a new pick-up request");
                } else {
                    return redirect()
                        ->route('getNewCreditCard')
                        ->with('fail', "We are getting trouble to validate your card. Please use an different card.");
                }
            }
        } else {
            return redirect()
                ->back()
                ->with('fail', "Oops! Something went wrong. Please contact to <a href='mailto: lisa@u-rang.com?subject=Pickup%20Request%20Error&body=Possible%20reason%20payment%20gateway%20error.'>lisa@u-rang.com</a> now.");
        }
    }

    public function postMyPickup($request)
    {
        //dd($request);

        /* global flag for sign discount check */
        $is_eligible_for_sign_up_discount = false;

        if ($request->address && $request->pick_up_date && $request->order_type != null && $request->pay_method) {
            $total_price = 0.00;

            $pick_up_req = new Pickupreq();
            if ($request->identifier == "admin") {
                $pick_up_req->user_id = $request->user_id;
                $this->checkIfReferalInsertedAdmin($request);
            } else {
                $pick_up_req->user_id = auth()->guard('users')->user()->id;
                $this->checkIfReferalInserted($request);
            }
            $pick_up_req->address = $request->address;
            $pick_up_req->address_line_2 = $request->address_line_2;
            $pick_up_req->apt_no = $request->apt_no;
            $pick_up_req->pick_up_date = date("Y-m-d", strtotime($request->pick_up_date));
            $pick_up_req->pick_up_type = $request->order_type == 1 ? 1 : 0;
            $pick_up_req->schedule = $request->schedule;
            $pick_up_req->delivary_type = $request->boxed_or_hung;
            $pick_up_req->starch_type = isset($request->strach_type) || $request->strach_type != null ? $request->strach_type : "No";
            $pick_up_req->need_bag = isset($request->urang_bag) ? 1 : 0;
            $pick_up_req->door_man = $request->doorman;
            $pick_up_req->time_frame_start = $request->time_frame_start;
            $pick_up_req->time_frame_end = $request->time_frame_end;
            $pick_up_req->special_instructions = isset($request->spcl_ins) ? $request->spcl_ins : null;
            $pick_up_req->driving_instructions = isset($request->driving_ins) ? $request->driving_ins : null;
            $pick_up_req->payment_type = $request->pay_method;
            $pick_up_req->order_status = 1;
            $pick_up_req->is_emergency = isset($request->isEmergency) ? 1 : 0;
            $pick_up_req->client_type = $request->client_type;
            $pick_up_req->coupon = $request->coupon;
            $pick_up_req->wash_n_fold = isset($request->wash_n_fold) ? 1 : 0;
            $data_table = json_decode($request->list_items_json);
            for ($i = 0; $i < count($data_table); $i++) {
                $total_price += $data_table[$i]->item_price * $data_table[$i]->number_of_item;
            }
            //dd($total_price);
            $pick_up_req->total_price = $request->order_type == 1 ? 0.00 : $total_price;

            //on emergency $7 add
            if (isset($request->isEmergency)) {
                if ($pick_up_req->total_price > 0) {
                    //dd($total_price);
                    $total_price += 7;
                    $pick_up_req->total_price = $total_price;
                }
            }
            $pick_up_req->discounted_value = $total_price;
            $calculate_discount = new SiteHelper();
            /* check if a newly signed up user then apply 10% discount on total price */
            $user = User::find($pick_up_req->user_id);
            if ($user->is_eligible_for_sign_up_discount == 1) {
                $is_eligible_for_sign_up_discount = true;
                $pick_up_req->discounted_value -= $pick_up_req->discounted_value * 10 / 100;
                $pick_up_req->sign_up_discount = 1;
                //dd("sign up discount: ".$pick_up_req->discounted_value);
                $user->is_eligible_for_sign_up_discount = 0;
                $user->save();
            }
            //now check this pick up req related to any ref or not
            if ($request->identifier == "admin") {
                $check_ref = ref::where('user_id', $request->user_id)->where('discount_status', 1)->where('is_expired', 0)->first();
            } else {
                $check_ref = ref::where('user_id', auth()->guard('users')->user()->id)->where('discount_status', 1)->where('is_expired', 0)->first();
            }
            //dd($total_price);
            if ($check_ref) {
                $pick_up_req->ref_discount = 1;
                // if($check_ref->discount_count>1)
                // {
                //     $check_ref->discount_count = $check_ref->discount_count-1;
                //     $check_ref->is_expired      =  0;
                // }
                // else
                // {
                //     $check_ref->is_expired      =  1;
                //     $check_ref->discount_count = 0;
                // }

                // $check_ref->save();
                if ($total_price > 0.0) {
                    $pick_up_req->discounted_value = $calculate_discount->updateTotalPriceOnRef($pick_up_req->discounted_value);
                    //dd("referral discount: ".$pick_up_req->discounted_value);
                }
            }


            if ($request->identifier == "admin") {
                $update_user_details = UserDetails::where('user_id', $request->user_id)->first();

            } else {
                $update_user_details = UserDetails::where('user_id', auth()->guard('users')->user()->id)->first();
            }
            $update_user_details->address_line_1 = $request->has('address') && strlen(trim($request->address)) ? $request->address : $update_user_details->address_line_1;
            $update_user_details->address_line_2 = $request->has('address_line_2') && strlen(trim($request->address_line_2)) ? $request->address_line_2 : $update_user_details->address_line_2;
            $update_user_details->personal_ph = $request->has('personal_ph') && strlen(trim($request->personal_ph)) ? $request->personal_ph : $update_user_details->personal_ph;
            $update_user_details->cell_phone = $request->has('cellph_no') && strlen(trim($request->cellph_no)) ? $request->cellph_no : $update_user_details->cell_phone;
            $update_user_details->off_phone = $request->has('officeph_no') && strlen(trim($request->officeph_no)) ? $request->officeph_no : $update_user_details->off_phone;
            $update_user_details->city = $request->has('city') && strlen(trim($request->city)) ? $request->city : $update_user_details->city;
            $update_user_details->state = $request->has('state') && strlen(trim($request->state)) ? $request->state : $update_user_details->state;
            $update_user_details->zip = $request->has('zip') && strlen(trim($request->zip)) ? $request->zip : $update_user_details->zip;
            $update_user_details->spcl_instructions = $request->has('driving_ins') && strlen(trim($request->driving_ins)) ? $request->driving_ins : null;
            $update_user_details->driving_instructions = $request->has('spcl_ins') && strlen(trim($request->spcl_ins)) ? $request->spcl_ins : null;
            $update_user_details->school_id = $request->has('school_donation_id') && strlen(trim($request->school_donation_id)) ? $request->school_donation_id : $update_user_details->school_id;
            $update_user_details->save();

            //coupon check
            if ($pick_up_req->coupon != null) {
                //helper function loading this
                $pick_up_req->discounted_value = $calculate_discount->discountedValue($pick_up_req->coupon, $pick_up_req->discounted_value);
                //dd("coupon discount: ".$pick_up_req->discounted_value);
            }
            if ($request->isDonate) {
                //save in android school prefrences table
                if ($request->identifier == "admin") {
                    $this->SavePreferncesSchool($request->user_id, $request->school_donation_id);
                } else {
                    //$pick_up_req->user_id = auth()->guard('users')->user()->id;
                    $this->SavePreferncesSchool(auth()->guard('users')->user()->id, $request->school_donation_id);
                }
                //dd($total_price);
                $percentage = SchoolDonationPercentage::first();
                if ($percentage == null) {
                    $new_percentage = 0;
                } else {
                    $new_percentage = $percentage->percentage / 100;
                }

                $pick_up_req->school_donation_id = $request->school_donation_id;
                //$pick_up_req->school_donation_amount = $request->school_donation_amount;
                $search = SchoolDonations::find($request->school_donation_id);
                if ($search) {
                    $present_pending_money = $search->pending_money;
                    /*//check coupon
                    if ($request->coupon) {
                        $discount = Coupon::where('coupon_code', $request->coupon)->first();
                        if ($discount && $discount->isActive == 1) {
                            dd($total_price);
                            $total_price = $total_price - ($total_price*$discount->discount/100);
                        }
                    }*/
                    $updated_pending_money = $present_pending_money + ($total_price * $new_percentage);
                    $search->pending_money = $updated_pending_money;
                    $search->save();
                }
                //save the school in user details for future ref
                if ($request->identifier == "admin") {
                    $update_user_details = UserDetails::where('user_id', $request->user_id)->first();

                } else {
                    $update_user_details = UserDetails::where('user_id', auth()->guard('users')->user()->id)->first();
                }
                $update_user_details->school_id = $request->school_donation_id;

            }

            $update_user_details->save();

            //dd($pick_up_req->toArray());
            if ($pick_up_req->save()) {

                // Save school donation

                // $schoolOrderDonations = new SchoolOrderDonations();
                // $schoolOrderDonations->school_id = $request->school_donation_id;
                // $schoolOrderDonations->donation_amount = $search_school->actual_total_money_gained;
                // $schoolOrderDonations->save();

                $tracker = new OrderTracker();


                //save in order tracker table
                $tracker = new OrderTracker();
                $tracker->pick_up_req_id = $pick_up_req->id;
                $tracker->user_id = $pick_up_req->user_id;
                $tracker->order_placed = $pick_up_req->created_at->toDateString();
                $tracker->order_status = 1;
                $tracker->original_invoice = $pick_up_req->total_price;
                $tracker->save();

                $address = (trim($pick_up_req->apt_no) ? $pick_up_req->apt_no . ", " : "") . $pick_up_req->address . ", " . $pick_up_req->address_line_2;
                if ($request->order_type == 1) {
                    if ($request->identifier == "admin") {
                        Event::fire(new PickUpReqEvent($request, 0, $is_eligible_for_sign_up_discount, $address));
                        return redirect()->route('getPickUpReqAdmin')->with('success', "Thank You! for submitting the order "/*.$expected_time*/);
                    } else {
                        Event::fire(new PickUpReqEvent($request, 0, $is_eligible_for_sign_up_discount, $address));
                        return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order "/*.$expected_time*/);

                    }
                } else {
                    //detailed pick up
                    $data = json_decode($request->list_items_json);
                    for ($i = 0; $i < count($data); $i++) {
                        $order_details = new OrderDetails();
                        $order_details->pick_up_req_id = $pick_up_req->id;
                        if ($request->identifier == "admin") {
                            $order_details->user_id = $request->user_id;
                        } else {
                            $order_details->user_id = auth()->guard('users')->user()->id;
                        }
                        $order_details->price = $data[$i]->item_price;
                        $order_details->items = $data[$i]->item_name;
                        $order_details->quantity = $data[$i]->number_of_item;
                        $order_details->payment_status = 0;
                        $order_details->save();
                    }
                    //create invoice
                    for ($j = 0; $j < count($data); $j++) {
                        $invoice = new Invoice();
                        if ($request->identifier == "admin") {
                            $invoice->user_id = $request->user_id;
                        } else {
                            $invoice->user_id = auth()->guard('users')->user()->id;
                        }
                        //$invoice->user_id = auth()->guard('users')->user()->id;
                        $invoice->pick_up_req_id = $pick_up_req->id;
                        $invoice->invoice_id = time();
                        $invoice->item = $data[$j]->item_name;
                        $invoice->quantity = $data[$j]->number_of_item;
                        $invoice->price = $data[$j]->item_price;
                        $invoice->list_item_id = $data[$j]->id;
                        //$invoice->coupon = $request->coupon;
                        $invoice->save();
                    }
                    if ($request->identifier == "admin") {
                        Event::fire(new PickUpReqEvent($request, $invoice->invoice_id, $is_eligible_for_sign_up_discount, $address));
                        return redirect()->route('getPickUpReqAdmin')->with('success', "Thank You! for submitting the order "/*.$expected_time*/);
                    } else {
                        //dd($request->request);
                        Event::fire(new PickUpReqEvent($request, $invoice->invoice_id, $is_eligible_for_sign_up_discount, $address));
                        return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order "/*.$expected_time*/);

                    }
                }
            } else {
                if ($request->identifier == "admin") {
                    return redirect()->route('getPickUpReqAdmin')->with('fail', "Could Not Save Your Details Now!");
                } else {
                    return redirect()->route('getPickUpReq')->with('fail', "Could Not Save Your Details Now!");
                }
            }
        } else {
            if ($request->identifier == "admin") {
                return redirect()->route('getPickUpReqAdmin')->with('fail', "Cannot be able to save pick up request make sure  type of order  is selected  correctly");
            } else {
                return redirect()->route('getPickUpReq')->with('fail', "Cannot be able to save pick up request make sure  type of order  is selected  correctly");
            }
        }
    }

    /*public function discountedValue($coupon, $total_price) {
        //dd($coupon);
        $find_coupon = Coupon::where('coupon_code', $coupon)->first();
        //dd($find_coupon);
        if ($find_coupon != null && $find_coupon->isActive == 1) {
            $total_price -= ($total_price*$find_coupon->discount)/100;
            return $total_price;
        }
        else
        {
            //no discount thats why total price is returned
            return $total_price;
        }
    }*/
    public function SavePreferncesSchool($userId, $schoolId)
    {
        //dd($userId."\n".$schoolId);
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

    public function getMyPickUps()
    {
        $pick_up_req = Pickupreq::where('user_id', auth()->guard('users')->user()->id)->with('order_detail', 'OrderTrack')->orderBy('created_at', 'desc')->get();
        //dd($pick_up_req);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.mypickups', compact('pick_up_req', 'site_details'));
    }

    public function postDeletePickUp(Request $request)
    {
        $id_to_del = $request->id;
        $search = Pickupreq::find($id_to_del);
        $trackOrder = OrderTracker::where('pick_up_req_id', $request->id)->first();
        if ($search) {
            if ($search->pick_up_type == 0) {
                $search->delete();
                $search_order_details = OrderDetails::where('pick_up_req_id', $id_to_del)->get();
                foreach ($search_order_details as $details) {
                    $details->delete();
                }
                if ($trackOrder->delete()) {
                    return 1;
                }

            } else {
                if ($search->delete()) {
                    if ($trackOrder->delete()) {
                        return 1;
                    }
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

    /*    private function sendAnEmail($request) {
            //mail should be send from here
            //dd($request->email);
            Mail::send('pages.sendEmail', array('name'=>$request->name,'email'=>$request->email,'password'=>$request->password),
            function($message) use($request)
            {
                $message->from(\App\Helper\ConstantsHelper::getClintEmail());
                $message->to($request->email, $request->name)->subject('U-rang Details');
            });
        }*/
    public function getSchoolDonations()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $list_school = SchoolDonations::with('neighborhood')->get();
        //dd($list_school);
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.school-donation', compact('site_details', 'login_check', 'logged_user', 'list_school'));
        } else {
            return view('pages.school-donation', compact('site_details', 'login_check', 'list_school'));
        }
    }

    public function getServices()
    {
        $obj = new NavBarHelper();
        $login_check = $obj->getCustomerData();
        $site_details = $obj->siteData();
        return view('pages.services', compact('login_check', 'site_details'));
    }

    public function getStandAloneService($slug)
    {
        $obj = new NavBarHelper();
        $login_check = $obj->getCustomerData();
        $site_details = $obj->siteData();
        switch ($slug) {
            case 'dry-clean':
                $data = Cms::where('identifier', 0)->first();
                break;
            case 'washNfold':
                $data = Cms::where('identifier', 1)->first();
                break;
            case 'corporate':
                $data = Cms::where('identifier', 2)->first();
                break;
            case 'tailoring':
                $data = Cms::where('identifier', 3)->first();
                break;
            case 'wet-cleaning':
                $data = Cms::where('identifier', 4)->first();
                break;
            default:
                # code...
                break;
        }
        return view('pages.servicesSingle', compact('login_check', 'site_details', 'data'));
    }

    public function getStandAloneNeighbor($slug)
    {
        $find = Neighborhood::where('url_slug', $slug)->first();
        if ($find) {
            $obj = new NavBarHelper();
            $site_details = $obj->siteData();
            $login_check = $obj->getCustomerData();
            $neighborhood = $obj->getNeighborhood();
            if ($login_check != null) {
                $logged_user= $obj->getCustomerData();
                return view('pages.neighborhoodSingle', compact('find', 'site_details', 'login_check', 'logged_user', 'neighborhood'));
            } else {
                return view('pages.neighborhoodSingle', compact('find', 'site_details', 'login_check', 'neighborhood'));
            }
        } else {
            abort(404);
        }
    }

    public function getComplaints()
    {
        //echo "some";
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.complaints', compact('site_details', 'login_check', 'logged_user'));
        } else {
            return view('pages.complaints', compact('site_details', 'login_check'));
        }
    }

    public function postComplaints(Request $request)
    {
        Event::fire(new SendCustomerComplaints($request));
        return redirect()->route('getComplaints')->with('success', 'Thank You, for contacting us we will get back to you shortly!');
    }

    /* public function getDryClean() {
         $obj = new NavBarHelper();
         $login_check = $obj->getCustomerData();
         $page_data = Cms::where('identifier', 0)->first();
         return view('stand_alone_pages.dryclean', compact('login_check', 'page_data'));
     }
     public function getWashNFold() {
         $obj = new NavBarHelper();
         $login_check = $obj->getCustomerData();
         $page_data = Cms::where('identifier', 1)->first();
         return view('stand_alone_pages.wash_n_fold', compact('login_check', 'page_data'));
     }
     public function getCorporate() {
         $obj = new NavBarHelper();
         $login_check = $obj->getCustomerData();
         $page_data = Cms::where('identifier', 2)->first();
         return view('stand_alone_pages.corporate', compact('login_check', 'page_data'));
     }
     public function getTailoring() {
         $obj = new NavBarHelper();
         $login_check = $obj->getCustomerData();
         $page_data = Cms::where('identifier', 3)->first();
         return view('stand_alone_pages.tailoring', compact('login_check', 'page_data'));
     }
     public function getWetCleaning() {
         $obj = new NavBarHelper();
         $login_check = $obj->getCustomerData();
         $page_data = Cms::where('identifier', 4)->first();
         return view('stand_alone_pages.wet-cleaning', compact('login_check', 'page_data'));
     }*/
    public function postCancelOrder(Request $request)
    {
        //return $request;
        $getPickup = Pickupreq::find($request->id);
        $order_tracker = OrderTracker::where('pick_up_req_id', $request->id)->first();
        if ($getPickup) {
            if ($request->flag == 'cancel') {
                $order_tracker->order_status = 5;
                $getPickup->order_status = 5;
            } else {
                $getPickup->order_status = 1;
                $order_tracker->order_status = 1;
            }
            //$getPickup->cancel_order =1;
            if ($getPickup->save() && $order_tracker->save()) {
                return 1;
            } else {
                return "could not save your data";
            }
        } else {
            return "could not find a pickup related to this id";
        }
    }

    public function lastPickUpReq(Request $request)
    {
        //return $request;
        $last_row = Pickupreq::orderBy('created_at', 'desc')->where('user_id', $request->user_id)->with('user_detail')->first();
        if (count($last_row) > 0) {
            return $last_row;
        } else {
            $registered_details = UserDetails::where('user_id', $request->user_id)->first();
            return $registered_details;
        }
    }

    public function checkCouponVailidity(Request $request)
    {
        //return $request;
        if ($request->coupon_value != null) {
            $find_coupon = Coupon::where('coupon_code', $request->coupon_value)->first();
            if ($find_coupon && $find_coupon->isActive == 1) {
                return 1;
            } else if ($find_coupon && $find_coupon->isActive == 0) {
                return 2;
            } else {
                return 0;
            }
        } else {
            return 1;
        }

    }

    public function getMobileAppPage()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        $page_data = MobileAppWys::first();
        $site_details = MobileAppWys::first();
        if ($login_check != null) {
            $logged_user = $obj->getCustomerData();
            return view('pages.mobileApp', compact('site_details', 'login_check', 'price_list', 'logged_user', 'neighborhood', 'page_data'));
        } else {
            return view('pages.mobileApp', compact('site_details', 'login_check', 'price_list', 'neighborhood', 'page_data'));
        }
    }

    public function postPushNotification(Request $request)
    {
        //self::mailQueue(29, "mail body");
        //dd($request);
        //dd(isset($request->whoiam));
        $array_pickup = array();
        $array_user_id = array();
        $this->validate($request, [
            'push_noti_text' => 'required',
            'pick_up_id' => 'required',
            'user_id' => 'required'
        ]);
        if ($request->multiple == 1) {
            $array_pickup = explode(",", $request->pick_up_id);
            $array_user_id = explode(",", $request->user_id);
            for ($i = 0; $i < count($array_pickup); $i++) {
                $insert_mul = new PushNotification();
                $insert_mul->pick_up_req_id = $array_pickup[$i];
                $insert_mul->user_id = $array_user_id[$i];
                $insert_mul->description = $request->push_noti_text;
                $insert_mul->author = isset($request->whoiam) ? auth()->guard('staffs')->user()->user_name : Auth::user()->username;
                $insert_mul->is_read = 0;
                $insert_mul->save();
                self::mailQueue($array_user_id[$i], $request->push_noti_text);
            }
            if ($request->whoiam) {
                //staff route
                return redirect()->route('getStaffOrders')->with('success', '<i class="fa fa-check" aria-hidden="true"></i> Successfully sent notification');
            } else {
                return redirect()->route('getCustomerOrders')->with('success', '<i class="fa fa-check" aria-hidden="true"></i> Successfully sent notification');
            }
        } else {
            //single goes here
            $insert = new PushNotification();
            $insert->pick_up_req_id = $request->pick_up_id;
            $insert->user_id = $request->user_id;
            $insert->author = isset($request->whoiam) ? auth()->guard('staffs')->user()->user_name : Auth::user()->username;
            $insert->description = $request->push_noti_text;
            $insert->is_read = 0;
            if ($insert->save()) {
                self::mailQueue($request->user_id, $request->push_noti_text);
                if ($request->whoiam) {
                    //staff route
                    return redirect()->route('getStaffOrders')->with('success', '<i class="fa fa-check" aria-hidden="true"></i> Successfully sent notification');
                } else {
                    return redirect()->route('getCustomerOrders')->with('success', '<i class="fa fa-check" aria-hidden="true"></i> Successfully sent notification');
                }

            } else {
                if ($request->whoiam) {
                    //staff route
                    return redirect()->route('getStaffOrders')->with('fail', '<i class="fa fa-times" aria-hidden="true"></i> error while sending notification please try again later!');
                } else {
                    return redirect()->route('getCustomerOrders')->with('fail', '<i class="fa fa-times" aria-hidden="true"></i> error while sending notification please try again later!');
                }

            }

        }

    }

    public static function mailQueue($user_id = null, $mail_text = null)
    {
        //dd("mail queue method");
        //dd("i m here");
        if ($user_id != null) {
            $email_obj = User::where('id', $user_id)->with('user_details')->first();
            if ($email_obj != null) {
                if ($email_obj->block_status == 0) {
                    $data = array('mail' => $mail_text, 'name' => $email_obj->user_details != null ? $email_obj->user_details->name : "Dummy Name", 'email' => $email_obj->email);
                    //dd($email_obj->email);
                    $email = $email_obj->email;
                    $name = $email_obj->user_details != null ? $email_obj->user_details->name : "Dummy Name";
                    Mail::later(2, 'email.push_notification', $data, function ($msg) use ($email, $name) {
                        $msg->from(env('ADMIN_EMAIL'), env('ADMIN_NAME'));
                        $msg->to($email, $name)->subject('Reminder');
                    });
                } else {
                    //user blocked
                    return false;
                }
            } else {
                //no data related to user id
                return false;
            }
        } else {
            //no user id passed
            return false;
        }
    }

    public function checkPushNotification(Request $request)
    {
        //return $request;
        $find_notification = PushNotification::where('user_id', $request->user_id)->where('is_read', 0)->orderBy('created_at', 'DESC')->get();
        if (count($find_notification) > 0) {
            return $find_notification;
        } else {
            return 0;
        }
    }

    public function getListNotification()
    {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        $find_notification = PushNotification::where('user_id', auth()->guard('users')->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('pages.notifications', compact('site_details', 'logged_user', 'find_notification'));
    }

    public function showmail($id)
    {
        $id = base64_decode($id);
        $update_read_status = PushNotification::find($id);
        if ($update_read_status) {
            $update_read_status->is_read = 1;
            $update_read_status->save();
            //dd($update_read_status);
            //Session::put('noti_id', $id);
            return redirect()->route('showDetailsNotification', base64_encode($id));

        } else {
            return redirect()->route('getListNotification')->with('fail', "Sorry! Unable to open email right now");
        }
    }

    public function showDetailsNotification($id)
    {
        $noti_id = base64_decode($id);
        $getDetails = PushNotification::find($noti_id);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        return view('pages.notification_details', compact('site_details', 'logged_user', 'getDetails'));
    }
}
