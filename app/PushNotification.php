<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PushNotification
 *
 * @property int $id
 * @property string $pick_up_req_id
 * @property string $user_id
 * @property string $author
 * @property string $description
 * @property int $is_read 0->unread , 1->read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\UserDetails $userDetails
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereIsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification wherePickUpReqId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PushNotification whereUserId($value)
 * @mixin \Eloquent
 */
class PushNotification extends Model
{
	public function getPickReq() {
		return $this->hasOne('App\Pickupreq', 'id', 'pick_up_req_id');
	}
	public function userDetails() {
		return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
	}
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
