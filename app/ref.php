<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ref extends Model
{
    public function user() {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function userDetails() {
    	return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }
}
