<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property bool $block_status 1 -> blocked , 0->open
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\CustomerCreditCardInfo $card_details
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderDetails[] $order_details
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pickupreq[] $pickup_req
 * @property-read \App\ref $refs
 * @property-read \App\UserDetails $user_details
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBlockStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_eligible_for_sign_up_discount 0 => not eligible, 1 => eligible
 * @method static \Illuminate\Database\Query\Builder|\App\User whereIsEligibleForSignUpDiscount($value)
 */
class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
	use Authenticatable;
    public function user_details() {
        return $this->hasOne('App\UserDetails', 'user_id', 'id');
    }
    public function card_details(){
    	return $this->hasOne('App\CustomerCreditCardInfo', 'user_id', 'id');
    }
    public function pickup_req()
    {
    	return $this->hasMany('App\Pickupreq','user_id','id');
    }
    public function order_details() {
        return $this->hasMany('App\OrderDetails', 'user_id', 'id');
    }
    public function refs() {
        return $this->hasOne('App\ref', 'user_id', 'id');
    }
}
