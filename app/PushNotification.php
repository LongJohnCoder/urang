<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
