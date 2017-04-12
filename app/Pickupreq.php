<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pickupreq
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string $pick_up_date
 * @property string $pick_up_type 1->fast_pickup , 0->detailed_pickup
 * @property string $schedule
 * @property string $delivary_type
 * @property string $starch_type
 * @property int $need_bag 1-> yes, 0-> no
 * @property int $door_man 1-> yes, 0-> no
 * @property string $special_instructions
 * @property string $driving_instructions
 * @property int $payment_type 1-> card, 2->cod, 3->check_payment
 * @property int $order_status 1->order placed, 2->picked up, 3->processed, 4->delivered, 5->order_cancelled
 * @property int $is_emergency 1-> yes , 0-> no
 * @property string $client_type
 * @property string $coupon
 * @property int $wash_n_fold 1->yes, 0-> no
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property float $total_price
 * @property bool $payment_status 0->pending , 1-> paid
 * @property int $school_donation_id
 * @property string $address_line_2
 * @property string $apt_no
 * @property string $time_frame_start
 * @property string $time_frame_end
 * @property float $discounted_value
 * @property int $ref_discount 1->discount available , 0-> not available
 * @property-read \App\OrderTracker $OrderTrack
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Invoice[] $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderDetails[] $order_detail
 * @property-read \App\SchoolDonations $school_donations
 * @property-read \App\User $user
 * @property-read \App\UserDetails $user_detail
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereAddressLine2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereAptNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereClientType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereCoupon($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereDelivaryType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereDiscountedValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereDoorMan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereDrivingInstructions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereIsEmergency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereNeedBag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereOrderStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq wherePaymentStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq wherePaymentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq wherePickUpDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq wherePickUpType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereRefDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereSchedule($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereSchoolDonationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereSpecialInstructions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereStarchType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereTimeFrameEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereTimeFrameStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Pickupreq whereWashNFold($value)
 * @mixin \Eloquent
 */
class Pickupreq extends Model
{

    public function user_detail()
    {
    	return $this->hasOne('App\UserDetails','user_id','user_id');
    }
    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
    public function order_detail()
    {
    	return $this->hasMany('App\OrderDetails','pick_up_req_id','id');
    }
    public function invoice() {
        return $this->hasMany('App\Invoice', 'pick_up_req_id', 'id');
    }
    public function school_donations() {
        return $this->hasOne('App\SchoolDonations', 'id', 'school_donation_id');
    }
    public function OrderTrack() {
        return $this->hasOne('App\OrderTracker', 'pick_up_req_id', 'id');
    }
}
