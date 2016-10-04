<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use Auth;
use Illuminate\Http\Request;
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

	public function acceptFriendRequest($friendshipid) {

		$friendRequest = Friend::find($friendshipid);
		$friendRequest->accepted = 1;
		$friendRequest->save();

		$friend = \App\User::find($friendRequest->user_id);

		$friend->notify(new FriendRequest($friend->id, $friendRequest->id, true));

		flash('You are now friends with ' . $friend->name, 'success');
		return redirect('/home');
	}

	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$friend = \App\User::find($friendid);
		$friend->notify(new FriendRequest($friendid, $friendRequest->id, false));
	}

	public function inviteFriendsForm() {
		return view('users/friends/invite');
	}

	public function multiexplode($delimiters, $string) {

		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return $launch;
	}

	public function inviteFriendsSend(Request $request) {
		$url = "http://www.social-prayer/register";
		$invitees = $this->multiexplode(array(",", "|", ":", ";", PHP_EOL), $request->invitees);
		print_r($invitees);
		foreach ($invitees as $invitee) {
			if (strpos($invitee, '@') && strpos($invitee, '.')) {
				$content = [];
				$content->greeting("Greetings, " . Auth::user()->name . "'s Friend");
				$content->line("You have been formally invited to pray on SocialPrayer.");
				$content->action("Sign Up", $url);
				$content->line("Have a blessed day!");
				\Mail::send('vendor.notifications.email', [$content], function ($message) {

					$message->to($invitee);
					//Add a subject
					$message->subject("SocialPrayer - " . Auth::user()->name . " just invited you to pray with them");

				});
			}
		}
	}
}
