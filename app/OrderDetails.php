<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderDetails
 *
 * @property int $id
 * @property int $pick_up_req_id
 * @property int $user_id
 * @property float $price
 * @property string $items
 * @property int $quantity
 * @property int $payment_status 1->paid, 0-> pending
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereItems($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails wherePaymentStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails wherePickUpReqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetails whereUserId($value)
 * @mixin \Eloquent
 */
class OrderDetails extends Model
{
    //
}
