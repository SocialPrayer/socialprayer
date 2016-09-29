<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use Auth;
use Notification;
use \App\Friend as Friend;

class UserController extends Controller {
	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$users = new \App\Users;

		Notification::send($users, new FriendRequest($friendid));
	}
}
