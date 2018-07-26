<?php

namespace App\Http\Controllers\Admin;
use App\Address;
use App\Http\Controllers\Controller;
use App\Kyc;
use App\Pre_sale;
use App\Transaction;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

//use App\Http\Controllers\Admin\AesEncryptionController;

class AdminHomeController extends Controller {
	//
	public function getDashboard(Request $request) {
		$user = Auth::user();
		$overallSummary = array();
		return view('admin.dashboard', compact('request', 'user', 'overallSummary'));
	}

	public function getUsers(Request $request) {
		$users = User::all();
		return view('admin.users', compact('request', 'users'));
	}

	public function getTransactions(Request $request) {
		$transactions = Transaction::all();
		return view('admin.transactions', compact('request', 'transactions'));
	}

	public function getApprovedKycs(Request $request) {
		$kycs = Kyc::join('users', 'kycs.user_id', '=', 'users.id')->where('kycs.status', 1)->get();
		return view('admin.kyc', compact('request', 'kycs'));
	}

	public function getPendingKycs(Request $request) {
		$kycs = Kyc::join('users', 'kycs.user_id', '=', 'users.id')->where('kycs.status', 0)->get();
		return view('admin.kyc', compact('request', 'kycs'));
	}

	public function getAllKycs(Request $request) {
		$kycs = Kyc::join('users', 'kycs.user_id', '=', 'users.id')->select('users.fullname', 'kycs.*')->get();
		return view('admin.kyc', compact('request', 'kycs'));
	}

	public function approveKyc(Request $request, $id) {
		$kycData = Kyc::find($id);
		$kycData->status = 1;
		$kycData->save();
		//Session::flash('success', 'KYC Approved.');
		return redirect()->back()->with('success', 'KYC Approved.');
	}

	public function rejectKyc(Request $request, $id) {
		$kycData = Kyc::find($id);
		$kycData->status = 0;
		$kycData->save();
		return redirect()->back()->with('warning', 'KYC Rejected.');
	}

	public function getAllNeoAddresses(Request $request) {
		$addresses = Address::where('currency_type', 'NEO')->get();
		return view('admin.addresses', compact('request', 'addresses'));
	}

	public function getAllBtcAddresses(Request $request) {
		$addresses = Address::where('currency_type', 'BTC')->get();
		return view('admin.addresses', compact('request', 'addresses'));
	}

	public function getAllEthAddresses(Request $request) {
		$addresses = Address::where('currency_type', 'ETH')->get();
		return view('admin.addresses', compact('request', 'addresses'));
	}

	public function getAllSubscribers(Request $request) {
		$subscribers = DB::table('subscribers')->get();
		$subscribersList = array();
		$i = 0;
		$decryptionObject = array();
		foreach ($subscribers as $subs) {
			$subscribersList[$i] = $subs;
			$decryptionObject[$i] = new AesEncryptionController($subscribersList[$i]->email, env('AES_ENC_KEY'), 256);
			$subscribersList[$i]->email = $decryptionObject[$i]->decrypt();
			$i++;
		}
		$subscribers = $subscribersList;
		return view('admin.subscribers', compact('request', 'subscribers'));
	}

	public function getAllInvalidTransactions(Request $request) {
		$transaction_hashes = DB::table('invalid_transactions')->join('users', 'users.id', 'invalid_transactions.user_id')->select('invalid_transactions.*', 'users.fullname')->get();
		return view('admin.transaction_hashes', compact('request', 'transaction_hashes'));
	}

	public function getAllIcoPreSaleDetails(Request $request) {
		$pre_sales = Pre_sale::all();
		$current_date = date('Y-m-d');
		foreach ($pre_sales as $pre_sale) {
			if ((strtotime($pre_sale->start_time) <= strtotime($current_date)) && (strtotime($pre_sale->end_time) >= strtotime($current_date))) {
				$pre_sale->is_completed = 1;
				$pre_sale->save();
			} else if ((strtotime($pre_sale->start_time) > strtotime($current_date)) && (strtotime($pre_sale->end_time) > strtotime($current_date))) {
				$pre_sale->is_completed = 0;
				$pre_sale->save();
			} else {
				$pre_sale->is_completed = 2;
				$pre_sale->save();
			}
		}
		return view('admin.presale', compact('request', 'pre_sales'));
	}
}
