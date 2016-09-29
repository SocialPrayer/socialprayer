<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use \App\Friend as Friend;

class UserController extends Controller {
	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		Notification::send($users, new InvoicePaid($friendid));
	}
}
