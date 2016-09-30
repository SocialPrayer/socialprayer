<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use \Auth;

class SocialiteAuthController extends Controller {
	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return Response
	 */
	public function redirectToProvider($driver) {
		return Socialite::driver($driver)->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleProviderCallback($driver) {
		$user = Socialite::driver($driver)->user();

		$data = [
			'name' => $user->getName(),
			'email' => $user->getEmail(),
		];

		Auth::login(User::firstOrCreate($data));

		// OAuth Two Providers
		$token = $user->token;
		$refreshToken = $user->refreshToken; // not always provided
		$expiresIn = $user->expiresIn;

		//$user->getAvatar(); //todo and save the avatar

		//print_r($user);
		redirect('/home');

	}
}