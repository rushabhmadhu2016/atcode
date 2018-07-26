<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_hash extends Model {
	//
	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
