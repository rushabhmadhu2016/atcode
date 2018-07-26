<?php

namespace App\Http\Controllers;
use App\Kyc;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Mailgun\Mailgun;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function saveQuickContact(Request $request) {
		$name = 'Name of Requester';
		$subject = 'Testing Subject';
		$message = 'Description';
		$mgClient = new Mailgun('86f1befa55b979119ab7b0c4840cd814-b892f62e-d643fd37');
		$domain = "sandboxb1d7efdc192e432486f0b579e10f3c20.mailgun.org";

		$result = $mgClient->sendMessage("$domain",
			array('from' => 'Mailgun Sandbox <postmaster@sandboxb1d7efdc192e432486f0b579e10f3c20.mailgun.org>',
				'to' => 'Avatar <rushabh.madhu@innvonix.com>',
				'subject' => 'Hello Avtar',
				'text' => 'Congratulations Avtar, you just sent an email with Mailgun!  You are truly awesome!'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = Auth::user();
		if ($user->user_type == 2) {
			return redirect()->route('adminDashboard');
		} else if ($user->user_type == 1) {
			return redirect()->route('userDashboard');
		} else {
			return view('home', compact('user'));
		}
	}

	public function getProfile() {
		$user = Auth::user();
		return view('edit-profile-form', compact('user'));
	}

	public function updateProfile(Request $request) {
		$user = Auth::user();
		$user->fullname = $request->get('fullname');
		$user->address = $request->get('address');
		$user->country = $request->get('country');
		$user->zip_code = $request->get('zip_code');
		$user->neo_wallet_detail = $request->get('neo_wallet_detail');
		$user->save();
		return redirect('update-profile')->with('message', 'Profile updated successfully.');
	}

	public function getKYC(Request $request) {
		$user = Auth::user();
		$kycs = Kyc::where('user_id', $user->id)->get();
		return view('kyc', compact('user', 'kycs'));
	}
}
