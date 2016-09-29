<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use Auth;
use \App\Friend as Friend;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function acceptFriendRequest($friendid) {

		$friendRequest = Friend::find($friendid);
		$friendRequest->accepted = true;
		$friendRequest->save();

		$friend->notify(new FriendRequest($friendid, $friendRequest->id, true));
	}

	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$friend = \App\User::find($friendid);
		$friend->notify(new FriendRequest($friendid, $friendRequest->id, false));
	}
}
