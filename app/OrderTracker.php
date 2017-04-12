<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderTracker
 *
 * @property int $id
 * @property int $pick_up_req_id
 * @property int $user_id
 * @property string $order_placed
 * @property string $picked_up_date
 * @property string $order_status 1->order placed, 2->picked up, 3->processed, 4->delivered
 * @property string $expected_return_date
 * @property string $return_date
 * @property string $original_invoice
 * @property string $final_invoice
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereExpectedReturnDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereFinalInvoice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereOrderPlaced($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereOrderStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereOriginalInvoice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker wherePickUpReqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker wherePickedUpDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereReturnDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderTracker whereUserId($value)
 * @mixin \Eloquent
 */
class OrderTracker extends Model
{
    //
}
