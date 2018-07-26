<?php

namespace App\Http\Controllers\Admin;

use App\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Message;
use App\Pre_sale;
use App\Setting;
use App\User;
use Auth;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AdminProfileController extends Controller {
	//

	public function sendToken(Request $request) {
		$from_address = $request->get("send_address");
		$to_address = $request->get("receiver_address");
		$token_amount = $request->get("token_amount");
		$from_private_key = $request->get("sender_private_key");
		$token_amount = $request->get("token_amount");
		$endpoint = "http://5.101.139.166:3000/sendAsset?from_address=" . $from_address . "&from_private_key=" . $from_private_key . "&to_address=" . $to_address . "&token_amount=" . $token_amount . "&sc_hash=59c8dd01f73cf7eb2d59467e080393852d553088";
		$result = file_get_contents($endpoint);
		$request_id = $request->get("request_id");
		DB::table('withdraw_requests')->where('id', $request_id)->update(['status' => 1]);
		echo $result;
	}

	public function manageUserStatus(Request $request) {
		$user = User::findorfail($request->get('id'));
		$user->status = $request->get('status');
		$user->save();
		return redirect('users')->with('success', 'User Status Updated.');
	}

	public function getAllWithdrawRequests(Request $request) {
		$withdral_requests = DB::table('withdraw_requests')->join('users', 'users.id', 'withdraw_requests.user_id')->select('withdraw_requests.*', 'users.fullname', 'users.neo_wallet_detail')->where('users.kyc_status', 1)->whereNotNull('neo_wallet_detail')->orderBy('withdraw_requests.status')->get();
		$allrequests = array();

		foreach ($withdral_requests as $wrequest) {
			$endpoint = "http://5.101.139.166:3000/isWalidAddress?address=" . $wrequest->neo_wallet_detail;
			$result = json_decode(file_get_contents($endpoint), 1);
			if ($result["success"]) {
				$allrequests[] = $wrequest;
			}
		}
		return view('admin.withdraw_requests', compact('request', 'allrequests'));
	}

	public function getEmails(Request $request) {
		$email = EmailTemplate::all();
		return view('admin.emails', compact('email'));
	}

	public function saveEmailTemplate(Request $request) {
		DB::beginTransaction();
		try {

			$validator = Validator::make($request->all(), [
				'emat_email_name' => 'required|unique:email_template,emat_email_name,' . base64_decode($request->email_id),
				'emat_email_subject' => 'required',
				'emat_email_message' => 'required',
			], [
				'emat_email_name.required' => 'Please enter email name.',
				'emat_email_name.unique' => 'This email name is already exists.',
				'emat_email_subject.required' => 'Please enter email subject.',
				'emat_email_message.required' => 'Please enter email message content.',
			]);

			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$email = EmailTemplate::where('id', base64_decode($request->email_id))->update(['emat_email_name' => $request->emat_email_name, 'emat_email_subject' => $request->emat_email_subject, 'emat_email_message' => $request->emat_email_message]);

			if ($email) {
				DB::commit();
				return redirect('emails')->with('success', 'Email Templated Updated.');
			} else {
				DB::rollback();
				return redirect()->back()->with('error', 'Email Templated Updated failed.');
			}

		} catch (Exception $e) {
			DB::rollback();
			flash($e->getMessage())->error()->important();
			return redirect()->back();
		}
	}

	public function getEmailData(Request $request, $id) {
		$email = EmailTemplate::where('id', $id)->first();
		return view('admin.edit_email', compact('email'));
	}

	public function getSettings(Request $request) {
		try {
			$settings = Setting::findorfail(1);
			return view('admin.settings', compact('settings'));
		} catch (Exception $e) {
			$msg = $e->getMessage();
			return view('admin.error', compact('msg'));
		}
	}

	public function putSettings(Request $request) {
		try {
			$updateData = array();
			$settings = Setting::findorfail(1);
			$settings->title = $request->get('title');
			$settings->token_price_neo = $request->get('token_price_neo');
			$prices = $this->getUSDPrices();

			$token_price_bth = ($prices["BTC"] * $request->get('token_price_neo')) / $prices["NEO"];
			$token_price_eth = ($prices["ETH"] * $request->get('token_price_neo')) / $prices["NEO"];

			$settings->token_price_bth = $token_price_bth;
			$settings->token_price_eth = $token_price_eth;
			$settings->admin_email = $request->get('admin_email');
			$settings->developer_email = $request->get('developer_email');

			$settings->referral_bouns_amount = $request->get('referral_bouns_amount');

			$settings->r1_start_bouns_amount = $request->get('r1_start_bouns_amount');
			$settings->r2_start_bouns_amount = $request->get('r2_start_bouns_amount');
			$settings->r3_start_bouns_amount = 0;

			$settings->r1_end_bouns_amount = $request->get('r1_end_bouns_amount');
			$settings->r2_end_bouns_amount = $request->get('r2_end_bouns_amount');
			$settings->r3_end_bouns_amount = 0;
			$settings->save();

			return redirect('settings')->with('success', 'Settings Updated.');
		} catch (Exception $e) {
			return redirect('settings')->with('error', 'Settings Updated fails.');
		}
	}

	public function getUSDPrices() {
		$endpoint = "https://api.coinmarketcap.com/v2/ticker/";
		$result = json_decode(file_get_contents($endpoint), 1);
		$output["BTC"] = $result["data"][1]["quotes"]["USD"]["price"];
		$output["ETH"] = $result["data"][1027]["quotes"]["USD"]["price"];
		$output["NEO"] = $result["data"][1376]["quotes"]["USD"]["price"];
		return $output;
	}

	public function changePassword(Request $request) {
		return view('admin.change_password');
	}

	public function updatePassword(Request $request) {
		if ($request->get('new_password') == $request->get('confirm_new_password')) {
			$user_id = Auth::user()->id;
			if (Hash::check($request->current_password, Auth::user()->password)) {
				User::where('id', $user_id)->update([
					'password' => bcrypt(str_replace(' ', '', $request->password)),
				]);
				return redirect()->back()->with('success', 'Password changed successfully');
			} else {
				return redirect()->back()->with('error', 'Please enter valid old password');
			}
		}
	}

	public function getMessages(Request $request) {
		$messages = Message::paginate(10);
		return view('admin.messages', compact('messages'));
	}

	public function getPresaleData(Request $request, $id) {
		$pre_sale = Pre_sale::findorfail($id);
		$settings = Setting::findorfail(1);
		return view('admin.edit_presale', compact('pre_sale', 'settings'));
	}

	public function updatePresaleData(Request $request) {
		try {
			$pre_sale = Pre_sale::findorfail($request->get('id'));
			$pre_sale->start_time = $request->start_time;
			$pre_sale->end_time = $request->end_time;
			$pre_sale->bonus = $request->bonus;
			$pre_sale->bonus2 = $request->bonus2;
			$pre_sale->save();
			return redirect()->back()->with('success', 'Presale details updated successfully.');
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Something went wrong');
		}
	}
}
