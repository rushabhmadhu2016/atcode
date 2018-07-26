<?php

namespace App;

use Auth;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'fullname', 'email', 'password', 'address', 'country', 'zip_code', 'neo_wallet_detail', 'sender_wallet_address', 'token_balance', 'kyc_status', 'user_type', 'status', 'avtar_token', 'referral_link', 'phone_number', 'token_2fa', '2fa_enabled', 'token_2fa_expiry', 'bonus_token_balance', 'referral_bouns_token_balance', 'referral_link', 'accept_terms',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function addresses() {
		return $this->hasMany('App\Address');
	}

	public function transaction_hash() {
		return $this->hasMany('App\Transaction_hash');
	}

	public function allocateAddresses($id) {
		$assignedAddresses = DB::table('addresses')->where('assigned_to', $id)->get();
		if (count($assignedAddresses) == 0) {
			$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'NEO')->select('id')->first();
			DB::table('addresses')->where('id', $address->id)->update(['assigned_to' => $id]);
			$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'BTC')->select('id')->first();
			DB::table('addresses')->where('id', $address->id)->update(['assigned_to' => $id]);
			$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'ETH')->select('id')->first();
			DB::table('addresses')->where('id', $address->id)->update(['assigned_to' => $id]);
		}
	}

	public function allocateNEOAddress($id) {
		$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'NEO')->select('id', 'address')->first();
		return $address->address;
	}

	public function allocateBTCAddress($id) {
		$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'BTC')->select('id', 'address')->first();
		DB::table('addresses')->where('id', $address->id)->update(['assigned_to' => $id]);
		return $address->address;
	}

	public function allocateETHAddress($id) {
		$address = DB::table('addresses')->whereNull('assigned_to')->where('currency_type', 'ETH')->select('id', 'address')->first();
		DB::table('addresses')->where('id', $address->id)->update(['assigned_to' => $id]);
		return $address->address;
	}

	public function generateUserActivityLog($action) {
		$insertData = array();
		$insertData['text'] = Auth::user()->fullname . ' has ' . $action;
		$insertData['status'] = 0;
		$insertData['created_at'] = date('Y-m-d H:i:s');
		DB::table('messages')->insert($insertData);
	}
}