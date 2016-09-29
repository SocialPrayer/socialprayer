<?php

namespace App\Http\Controllers;

use Auth;
use \App\Friend as Friend;

class UserController extends Controller {
	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$url = url('/user/acceptfriend/' . Auth::id());

		$friend = \App\User::find($friendid);

		return (new \MailMessage)
			->greeting('Hello ' . $friend->name . '!')
			->line(Auth::user()->name . ' has requested to be your friend and pray with you.')
			->action('Accept Friendship', $url)
			->line('Have a blessed day!');
	}
}
