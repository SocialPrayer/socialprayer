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
	public function __construct($friendshipid, $friendid, $accepted = false) {
		$this->friendid = $friendid;
		$this->friendshipid = $friendshipid;
		$this->accepted = $accepted;
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

		if ($this->accepted) {
			$url = url('/home');
			return (new MailMessage)
				->subject('SocialPrayer - Friendship Accepted')
				->greeting('Hello ' . $friend->name . '!')
				->line(Auth::user()->name . ' has accepted your request to be friends.')
				->action('Pray', $url)
				->line('Have a blessed day!');
		} else {

			$url = url('/user/acceptfriend/' . $this->friendshipid);

			return (new MailMessage)
				->subject('SocialPrayer - New Friendship Request')
				->greeting('Hello ' . $friend->name . '!')
				->line(Auth::user()->name . ' has requested to be your friend and pray with you.')
				->action('Accept Friendship', $url)
				->line('Have a blessed day!');

		}

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
