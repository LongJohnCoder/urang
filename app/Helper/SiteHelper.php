<?php
namespace App\Helper;
use Session;
use App\CustomerCreditCardInfo;
use App\Coupon;
use App\ref;
class SiteHelper 
{
	public function showCardNumber($user_id) {
		//return $user_id;
		$card_details = CustomerCreditCardInfo::where('user_id', $user_id)->first();
		return $card_details;
	}

    //this function calculate coupon discount
	public function discountedValue($coupon, $total_price) {
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
    }

    //this function calculate referrel price
    public function updateTotalPriceOnRef($total_price) {
        $total_price -= ($total_price*10)/100;
        return $total_price;
    }
    public function refOrNot($email) {
        $is_ref = ref::where('referred_person', $email)->where('discount_status', 1)->with('userDetails')->first();
        if ($is_ref) {
            return $is_ref;
        }
        else
        {
            return 0;
        }
    }
	
}