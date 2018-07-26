<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Address extends Model {
	//
	protected $table = 'addresses';
	protected $fillable = [
		'address', 'currency_type', 'private_key', 'assigned_to', 'balance'];

	public function user() {
		return $this->hasOne('App\User', 'id', 'assigned_to');
	}
}
