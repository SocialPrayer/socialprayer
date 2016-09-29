<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use Auth;
use \App\Friend as Friend;

class UserController extends Controller {
	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$friend = \App\User::find($this->friendid);
		$friend->notify(new FriendRequest($friendid));
	}
}
