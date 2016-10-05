<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invite extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		$url = "http://www.social-prayer/register";
		return $this->view('vendor.notifications.email')
			->with([
				'level' => 'info',
				'subject' => 'SocialPrayer - ' . Auth::user()->name . ' just invited you to pray with them',
				'greeting' => 'Greetings ' . Auth::user()->name . 's Friend',
				'introLines' => ['You have been formally invited to pray on SocialPrayer.'],
				'actionText' => 'Sign Up',
				'actionUrl' => $url,
				'outroLines' => ['Have a blessed day!'],
			]);

	}
}
