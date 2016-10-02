<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendPrayed extends Notification {
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($friendid, $prayerid) {
		$this->friendid = $friendid;
		$this->prayerid = $prayerid;
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
		$friend = \App\User::find($this->friendid);

		$url = url('/prayer/' . $this->prayerid);
		return (new MailMessage)
			->subject('SocialPrayer - A friend of just prayed')
			->greeting('Hello ' . $friend->name . '!')
			->line('A friend of yours, ' . Auth::user()->name . ', just prayed.')
			->action('View Prayer', $url)
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
