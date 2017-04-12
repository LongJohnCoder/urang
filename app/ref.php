<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ref
 *
 * @property int $id
 * @property int $user_id
 * @property string $referred_person
 * @property string $discount_status 1->active, 0->inactive
 * @property int $is_expired 1->expired, 0-> available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $referral_email
 * @property string $is_referal_done 0->not done,1->done
 * @property string $discount_count
 * @property-read \App\User $user
 * @property-read \App\UserDetails $userDetails
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereDiscountCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereDiscountStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereIsExpired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereIsReferalDone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereReferralEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereReferredPerson($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ref whereUserId($value)
 * @mixin \Eloquent
 */
class ref extends Model
{
    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function userDetails() {
    	return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }
}
