<?php

namespace App\Notifications;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequest extends Notification {
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($friendid) {
		$this->friendid = $friendid;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		$url = url('/user/acceptfriend/' . Auth::id());

		$friend = \App\User::find($$this->friendid);

		return (new MailMessage)
			->subject('SocialPrayer - New Friendship Request')
			->greeting('Hello ' . $friend->name . '!')
			->line(Auth::user()->name . ' has requested to be your friend and pray with you.')
			->action('Accept Friendship', $url)
			->line('Have a blessed day!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
