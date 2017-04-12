<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invoice
 *
 * @property int $id
 * @property int $user_id
 * @property int $pick_up_req_id
 * @property int $invoice_id
 * @property string $item
 * @property int $quantity
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $list_item_id
 * @property string $custom_item_add_id
 * @property-read \App\Pickupreq $pick_up_req
 * @property-read \App\User $user
 * @property-read \App\UserDetails $user_details
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCustomItemAddId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereInvoiceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereItem($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereListItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice wherePickUpReqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUserId($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    public function user(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function user_details(){
    	return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }
    public function pick_up_req() {
    	return $this->hasOne('App\Pickupreq', 'id', 'pick_up_req_id');
    }
}
