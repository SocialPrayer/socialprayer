<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UserProfile;
use App\User;
use Config;
use Illuminate\Foundation\Auth\RegistersUsers;
use Request;
use Validator;

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
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		if (env('APP_ENV') == 'Production') {
			// $recaptcha = new \ReCaptcha\ReCaptcha(Config::get('services.google_reCaptcha.secret'));
			// $resp = $recaptcha->verify($data['g-recaptcha-response'], Request::ip());
			// if ($resp->isSuccess()) {
				return Validator::make($data, [
					'firstname' => 'required|max:255',
					'lastname' => 'required|max:255',
					'email' => 'required|email|max:255|unique:users',
					'password' => 'required|min:6|confirmed',
				]);
			// } else {
			// 	return Validator::make($data, [
			// 		'firstname' => 'required|max:255',
			// 		'lastname' => 'required|max:255',
			// 		'email' => 'required|email|max:255|unique:users',
			// 		'password' => 'required|min:6|confirmed',
			// 		'g-recaptcha-response' => 'required|max:5',
			// 	]);
			// 	$errors = $resp->getErrorCodes();
			// }
		} else {
			return Validator::make($data, [
				'firstname' => 'required|max:255',
				'lastname' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required|min:6|confirmed',
			]);
		}
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {

		$user = User::create([
			'name' => $data['firstname'] . ' ' . $data['lastname'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);

		$userProfile = UserProfile::create([
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'email' => $data['email'],
			'user_id' => $user->id,
		]);

		return $user;

	}
}
