<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles authenticating users for the application and
		    | redirecting them to your home screen. The controller uses a trait
		    | to conveniently provide its functionality to your applications.
		    |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/userDashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

	public function validateReCaptcha($params) {
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$secret = env('RE_CAP_SECRET');
		$client = new Client();
		$response = $client->post(
			'https://www.google.com/recaptcha/api/siteverify',
			['form_params' =>
				[
					'secret' => env('RE_CAP_SECRET'),
					'response' => $params,
				],
			]
		);
		$body = json_decode((string) $response->getBody());
		return $body->success;
	}

	public function login(Request $request) {

		$recaptchaData = $request->get('g-recaptcha-response');
		if ($this->validateReCaptcha($recaptchaData)) {

			$this->validateLogin($request);

			if ($this->hasTooManyLoginAttempts($request)) {
				$this->fireLockoutEvent($request);
				return $this->sendLockoutResponse($request);
			}

			if ($this->attemptLogin($request)) {
				return $this->sendLoginResponse($request);
			}
			$this->incrementLoginAttempts($request);
			return $this->sendFailedLoginResponse($request);

		} else {
			return redirect()->back()->with('error', 'Invalid Captcha');
		}
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect('/login');
	}

	public function authenticated(Request $request, $user) {
		if ($user->status == 0 && $user->user_type == 1) {
			Auth::logout();
			return redirect()->back()->withErrors(['email' => 'Your Account is not activated.'])->withInput();
		}
		return;
	}

}
