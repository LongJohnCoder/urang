<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Coupon
 *
 * @property int $id
 * @property string $coupon_code
 * @property float $discount
 * @property int $isActive 1->active, 0->inactive
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereCouponCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    //
}
