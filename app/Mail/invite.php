<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invite extends Mailable {
	use Queueable, SerializesModels;
	
	public $message;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($message) {
		$this->message = $message;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
	
		$url = env('APP_URL') . "/register";
		
		$personalMessage = "";
		
		if($this->message != ""){ 
				$personalMessage = '<br />Personal Message from ' . Auth::user()->name . ': ' . $message;
		}
		
		return $this->view('vendor.notifications.email')
			->subject('SocialPrayer - ' . Auth::user()->name . ' just invited you to pray with them')
			->with([
				'level' => 'info',
				'subject' => 'SocialPrayer - ' . Auth::user()->name . ' just invited you to pray with them',
				'greeting' => 'Greetings,',
				'introLines' => ['You have been invited by ' . Auth::user()->name . ' to pray on SocialPrayer. A new place on the internet to pray either by yourself or together with those you know and love. You can also pray anonymously and it will not save your name, or just with God and he will be the only one to see it. Ever!' . $personalMessage],
				'actionText' => 'Sign Up and Pray',
				'actionUrl' => $url,
				'outroLines' => ['Have a blessed day!'],
			]);

	}
}
