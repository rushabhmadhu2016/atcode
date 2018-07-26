<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Admin\AesEncryptionController;
use App\Pre_sale;
use App\Setting;
use App\Transaction;
use App\User;
use Auth;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller {
	//
	public function userDashboard(Request $request) {
		$settings = Setting::first();
		$pre_sales = Pre_sale::all();
		$user = Auth::user();
		return view('user.dashboard', compact('user', 'settings', 'pre_sales'));
	}

	public function getUserProfile(Request $request) {
		$profile = Auth::user();
		$encryptionObject = new AesEncryptionController($profile->email, env('AES_ENC_KEY'), 256);
		$master_pay = $encryptionObject->encrypt();
		$profile->referral_link = url('/referral/') . '/' . $master_pay;
		$profile->save();
		return view('user.profile', compact('profile', 'request'));
	}

	public function validateNEOAddress($address) {
		$url = 'http://5.101.139.166:3000/isWalidAddress?address=' . $address;
		$result = json_decode(file_get_contents($url), 1);
		if (isset($result["success"]) && $result["success"] == true) {
			return true;
		} else {
			return false;
		}
	}

	public function updateWithdrawalRequest(Request $request) {
		try {
			var_dump($request->all());exit;
			if ($request->get('withdraw_funds') == 1) {
				$user = Auth::user()->id;
				$withdraw_requests = array();
				$withdraw_requests["user_id"] = $user->id;
				$withdraw_requests["token_amount"] = $user->token_balance + $user->bonus_token_balance;
				$withdraw_requests["created_at"] = date('Y-m-d H:i:s');
				$withdraw_requests["status"] = 0;
				DB::table('withdraw_requests')->insert($withdraw_requests);
				$bonusData = DB::table('referral_bonus')->join('users', 'users.id', 'referral_bonus.user_id')->where('users.kyc_status', 1)->select('users.bonus')->get();
				$bonusTokens = 0;
				foreach ($bonusData as $bonusRecord) {
					$bonusTokens = $bonusTokens + $bonusRecord->bonus;
				}
				if ($bonusTokens > 0) {
					$withdraw_requests = array();
					$withdraw_requests["user_id"] = $user->id;
					$withdraw_requests["token_amount"] = $bonusTokens;
					$withdraw_requests["created_at"] = date('Y-m-d H:i:s');
					$withdraw_requests["status"] = 0;
					DB::table('withdraw_requests')->insert($withdraw_requests);
				}
				$user->generateUserActivityLog(' put request for withdraw tokens');
				/* Send mail to Admin and User
					$mailParams = array();
					$mailParams['fullname'] = $userData->fullname;
					$mailParams['email'] = $userData->email;
					$mailParams['currency'] = $this->currency;
					$mailParams['amount'] = $amount;
					$mailParams['transaction_date'] = $current_date;
					$mailParams['token'] = $tokenToAllocate;
					$mailParams['bonus'] = $bonus;
					$mailParams['refferal_bonus'] = (($tokenToAllocate * $settings->referral_bouns_amount) / 100);
					$mailParams['address'] = $receivingAddress;
				*/
			}
			return request()->back()->with('success', 'Your withdraw request placed successfully.');
		} catch (Exception $e) {
			return request()->back()->with('error', 'Your withdraw failed. Please contact Admin');
		}
	}

	public function updateUserProfile(Request $request) {
		try {
			$user = Auth::user();
			$user->fullname = $request->get('fullname');
			$user->address = $request->get('address');
			$user->country = $request->get('country');
			$user->zip_code = $request->get('zip_code');
			$neo_address = $request->get('neo_wallet_detail');
			if ($request->has('neo_wallet_detail') && strlen(trim($neo_address)) > 0) {
				if ($this->validateNEOAddress($neo_address)) {
					$user->neo_wallet_detail = $request->get('neo_wallet_detail');
				} else {
					return redirect()->back()->with(['error' => 'Invalid NEO Address.',
						'neo_wallet_detail' => $request->get('neo_wallet_detail')]);
				}
			}
			$user->save();
			$user->generateUserActivityLog('update profile.');
			return redirect()->back()->with('success', 'Profile Updated...');
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Something is wrong updated.' . $e->getMessage());
		}
	}

	public function getTransactions(Request $request) {
		$transactions = Transaction::where('user_id', Auth::user()->id)->get();
		return view('user.transactions', compact('request', 'transactions'));
	}

	public function changePassword(Request $request) {
		return view('user.change_password', compact('request'));
	}

	public function updateUserPassword(Request $request) {
		if ($request->get('new_password') == $request->get('confirm_new_password')) {
			$user_id = Auth::user()->id;
			if (Hash::check($request->current_password, Auth::user()->password)) {
				User::where('id', $user_id)->update([
					'password' => bcrypt($request->get('new_password')),
				]);
				$user->generateUserActivityLog('changed password.');
				return redirect()->back()->with('success', 'Password changed successfully');
			} else {
				return redirect()->back()->with('error', 'Please enter valid old password');
			}
		}
	}

	public function getUSDPrices() {
		$endpoint = "https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,NEO&tsyms=USD";
		$result = json_decode(file_get_contents($endpoint), 1);
		$output["BTC"] = $result["BTC"]["USD"];
		$output["ETH"] = $result["ETH"]["USD"];
		$output["NEO"] = $result["NEO"]["USD"];
		return $output;
	}

	public function buyToken(Request $request) {
		try {

			$this->getUSDPrices();
			$settings = Setting::first();
			$pre_sales = Pre_sale::all();
			$user = Auth::user();
			$addresList = array();
			$current_tracker = array();
			$user_addresses = DB::table('addresses')->where('assigned_to', Auth::user()->id)->get();
			foreach ($user_addresses as $address) {
				$addresList[] = $address->address;
			}
			$prices = $this->getUSDPrices();

			$token_price_neo = $settings->token_price_neo;
			$token_price_bth = ($prices["BTC"] * $token_price_neo) / $prices["NEO"];
			$token_price_eth = ($prices["ETH"] * $token_price_neo) / $prices["NEO"];
			$settings->token_price_eth = $token_price_eth;
			$settings->token_price_bth = $token_price_bth;
			$settings->save();

			if (count($addresList)) {
				Auth::user()->allocateAddresses(Auth::user()->id);
			}
			$current_date = date('Y-m-d');
			$current_trackers = DB::table('monitorings')->whereIn('address', $addresList)->get();
			$countdown = 0;

			foreach ($current_trackers as $ctracker) {
				$end_time = strtotime($ctracker->end_time);
				if ($ctracker->other >= 3 && strtotime($current_date) > $end_time) {
					continue;
				} else {
					$countdown = 1;
					$current_tracker = $ctracker;
				}
			}
			//var_dump($current_tracker);	exit;
			/*GET User Addresses -- START*/
			$user_neo_address = '';
			$user_btc_address = '';
			$user_eth_address = '';

			foreach ($user_addresses as $address) {
				if ($address->currency_type == "BTC") {
					$user_btc_address = $address->address;
				} else if ($address->currency_type == "ETH") {
					$user_eth_address = $address->address;
				} else if ($address->currency_type == "NEO") {
					$user_neo_address = $address->address;
				}
			}

			if (strlen($user_neo_address) <= 0) {
				$user_neo_address = Auth::user()->allocateNEOAddress(Auth::user()->id);
			}
			if (strlen($user_btc_address) <= 0) {
				$user_btc_address = Auth::user()->allocateBTCAddress(Auth::user()->id);
			}
			if (strlen($user_eth_address) <= 0) {
				$user_eth_address = Auth::user()->allocateETHAddress(Auth::user()->id);
			}
			/*GET User Addresses -- END*/

			/*Find current working presale --START*/
			$current_presale = '';
			$round = 0;
			if ((strtotime($current_date) >= strtotime($pre_sales[0]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[0]->end_time))) {
				$round = 1;
				$bonus_rate1 = $pre_sales[0]->bonus;
				$bonus_rate2 = $pre_sales[0]->bonus2;
				$current_presale = $pre_sales[0];
			} else if ((strtotime($current_date) >= strtotime($pre_sales[1]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[1]->end_time))) {
				$round = 2;
				$bonus_rate1 = $pre_sales[1]->bonus;
				$bonus_rate2 = $pre_sales[1]->bonus2;
				$current_presale = $pre_sales[0];
			} else if ((strtotime($current_date) >= strtotime($pre_sales[2]->start_time)) && (strtotime($current_date) <= strtotime($pre_sales[2]->end_time))) {
				$round = 3;
				$bonus_rate1 = $pre_sales[2]->bonus;
				$bonus_rate2 = $pre_sales[2]->bonus2;
				$current_presale = $pre_sales[0];
			}
			/*Find current working presale --END*/

			/*Redirect User to Dashboard page if not presale is going on --START*/
			if ($round == 0) {
				return redirect('userDashboard')->with('warning', 'Sale is running at present');
			}
			/*Redirect User to Dashboard page if not presale is going on --END */
			return view('user.buy_token', compact('request', 'settings', 'pre_sales', 'user_addresses', 'current_tracker', 'token_price_neo', 'token_price_bth', 'token_price_eth', 'user_neo_address', 'user_btc_address', 'user_eth_address', 'current_presale', 'round', 'bonus_rate1', 'bonus_rate2', 'current_date', 'countdown', 'current_tracker'));
		} catch (Exception $e) {
			return redirect('userDashboard')->with('warning', 'Unhandled Exception occurred : ' . $e->getMessage());
		}
	}

	public function getUserWallet(Request $request) {
		$transactions = Transaction::where('user_id', Auth::user()->id)->get();
		return view('user.user_wallet', compact('request', 'transactions'));
	}

	public function getUserReferrals(Request $request) {
		$referrals = User::where('referrar_id', Auth::user()->id)->get();
		return view('user.user_referrals', compact('request', 'referrals'));
	}

	public function placeOrder(Request $request) {
		try {
			//var_dump($request->all());exit;
			if ($this->hasExistingMonitoring($request->get("monitor_address"), $request->get("selected_currency"))) {
				$monitoringData = array();
				$monitoringData["user_id"] = Auth::user()->id;
				$monitoringData["address"] = $request->get("monitor_address");
				$monitoringData["currency_type"] = $request->get("selected_currency");
				$last_balance = $this->getUserLastBalance(strtolower($request->get("selected_currency")));
				$monitoringData["last_balance"] = ($last_balance == NULL) ? 0 : $last_balance;
				$monitoringData["start_time"] = date('Y-m-d H:i:s');
				$monitoringData["end_time"] = date('Y-m-d H:i:s', strtotime('1 hour'));
				$monitoringData["status"] = 1;
				$monitoringData["created_at"] = date('Y-m-d H:i:s');
				DB::table('monitorings')->insert($monitoringData);
			} else {
				$monitoringData = array();
				$monitoringData["end_time"] = date('Y-m-d H:i:s', strtotime('1 hour'));
				DB::table('monitorings')->where('address', $request->get('monitor_address'))->update($monitoringData);
			}
			return redirect()->back()->with('success', 'We are checking for your transactions, please keep patient. Thank you for investing in Avatarlife.');
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function getUserLastBalance($currency = 'neo') {
		if ($currency == 'neo') {
			return Auth::user()->neo_balance;
		} else if ($currency == 'btc') {
			return Auth::user()->btc_balance;
		} else if ($currency == 'eth') {
			return Auth::user()->eth_balance;
		}
	}

	public function hasExistingMonitoring($address, $currency) {
		$address = DB::table('monitorings')->where('address', $address)->where('currency_type', $currency)->first(); //->where('other', '>', 3)
		if (count($address) > 0) {
			/*if (strtotime($address->end_time) < strtotime(date('Y-m-d H:i:s'))) {
					return false;
				} else {
					return true;
			*/
			return false;
		} else {
			return true;
		}
	}
}
