<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SendMailController;
use App\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Register Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users as well as their
		    | validation and creation. By default this controller uses a trait to
		    | provide this functionality without requiring any additional code.
		    |
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/login';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	public function register(Request $request) {
		$this->validator($request->all())->validate();
		event(new Registered($user = $this->create($request->all())));

		// $this->guard()->login($user);

		return $this->registered($request, $user)
		?: redirect($this->redirectPath())->with('success', 'Registration success. Activation link has been sent to your email account.');
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'terms' => 'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		$custom_token = hash_hmac('sha256', str_random(40), config('app.key'));
		$user = User::create([
			'fullname' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'avtar_token' => $custom_token,
			'accept_terms' => 1,
		]);
		$sc = SendMailController::dynamicEmail([
			'email_id' => 2,
			'user_id' => $user->id,
		]);
		return $user;
	}
}
