<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\AesEncryptionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMailController;
use App\User;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Session;

class GeneralController extends Controller {

	public function saveNewsLetter(Request $request) {
		$sendResponse = array();
		try {
			if ($request->has('email')) {
				$encryptionObject = new AesEncryptionController($request->get('email'), env('AES_ENC_KEY'), 256);
				$email = $encryptionObject->encrypt();
				$existing = DB::table('subscribers')->where('email', $email)->get();
				if (count($existing) > 0) {
					$sendResponse['message'] = 'Subscriber already exist.';
					$sendResponse['code'] = 200;
				} else {
					$insertData = array();
					$insertData["email"] = $email;
					$insertData["status"] = 1;
					$insertData["created_at"] = date('Y-m-d H:i:s');
					DB::table('subscribers')->insert($insertData);
					$sendResponse['message'] = 'Thanks for Subscribe';
					$sendResponse['code'] = 200;
				}
			} else {
				$sendResponse['message'] = 'Subscriber email not specified';
				$sendResponse['code'] = 200;
			}
		} catch (Exception $e) {
			$sendResponse['message'] = 'Something went wrong, we are checking... Thanks to co-operate.';
			$sendResponse['code'] = 500;
		}
		echo json_encode($sendResponse);
	}

	//
	public static function callRPC($data) {
		$runfile = 'http://5.101.139.166:10332';
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $runfile,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_POSTFIELDS => json_encode($data),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;
	}

	public function thankYou(Request $request) {
		$message = '';
		if (Session::has('message')) {
			$message = Session::get('success');
		}
		return view('thank-you', compact('request', 'message'));
	}

	public function saveContactFrom(Request $request) {
		$data = array();
		$data['name'] = $request->get('name');
		$data['email'] = $request->get('email');
		$data['content'] = $request->get('message');
		$data['email_id'] = 4;
		$sc = SendMailController::dynamicEmail([
			'email_id' => 4,
			'user_id' => 1,
			'data' => $data,
		]);
		return redirect('thank-you')->with(['message' => 'Your contact inquiry saved successfully. We will get back to you soon.']);
	}

	public function test(Request $request) {
		$params = ['jsonrpc' => "2.0", 'method' => "getaccountstate", 'params' => array('Adr3XjZ5QDzVJrWvzmsTTchpLRRGSzgS5A'), 'id' => "1"];
		$neo_asset_id = '0xc56f33fc6ecfcd0c225c4ab356fee59390af8560be0e930faebe74a6daff7c9b';
		$neo_balance = 0;
		$result = json_decode($this->callRPC($params), 1);
		if (isset($result["result"])) {
			if (isset($result["result"]["balances"]) && count($result["result"]["balances"]) > 0) {
				if (isset($result["result"]["balances"][0]["asset"]) && $result["result"]["balances"][0]["asset"] == $neo_asset_id) {
					$neo_balance = $result["result"]["balances"][1]["value"];
				} else if (isset($result["result"]["balances"][1]["asset"]) && $result["result"]["balances"][1]["asset"] == $neo_asset_id) {
					$neo_balance = $result["result"]["balances"][1]["value"];
				} else {
					$neo_balance = 0;
				}
				$neo_balance;
			}
		}
		var_dump($result);
	}

	public function saveQuickContact(Request $request) {
		$data = array();
		$data['name'] = $request->get('name');
		$data['email'] = $request->get('email');
		$data['quote'] = $request->get('quote');

		$sc = SendMailController::dynamicEmail([
			'email_id' => 4,
			'data' => $data,
		]);
	}

	public function fetchData(Request $request) {
		return date('H:i:s');
	}

	public function setReferral(Request $request, $id) {
		if (Auth::guest()) {
			return redirect()->guest('login');
		}
		try {
			$decryptionObject = new AesEncryptionController($id, env('AES_ENC_KEY'), 256);
			$email = $decryptionObject->decrypt();
			$referral_user = User::where('email', $email)->first();
			$referral_user->referrar_id = Auth()->user()->id;
			$referral_user->save();
			if (Auth::user()->type == 2) {
				$redirectString = 'adminDashboard';
			} else {
				$redirectString = 'userDashboard';
			}
			Session::put('redirect', url($redirectString));
			return redirect('/login');
		} catch (Exception $e) {

		}

	}

	public function activateAccount(Request $request, $token) {
		$verifyUser = User::where('avtar_token', $token)->first();
		$verifyUser->allocateAddresses($verifyUser->id);
		$status = null;
		if (isset($verifyUser)) {
			if ($verifyUser->status == 0) {
				$verifyUser->status = 1;
				$verifyUser->save();
				return redirect('login')->with('success', 'Your account is activated successfully.');
			} else {
				$status = 'Your Account is already activated..';
			}
		} else {
			$status = 'System is not able to detect the user';
		}
		return redirect('login')->with('status', $status);
	}
}
