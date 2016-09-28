<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function prayer() {
		return $this->hasMany('App\Prayer');
	}

	public function userprofile() {
		return $this->hasMany('App\UserProfile');
	}

	public function prayalong() {
		return $this->hasMany('App\PrayAlong');
	}

	// friendship that I started
	function friendsOfMine() {
		return $this->belongsToMany('User', 'friends', 'user_id', 'friend_id')
			->wherePivot('accepted', '=', 1) // to filter only accepted
			->withPivot('accepted'); // or to fetch accepted value
	}

	// friendship that I was invited to
	function friendOf() {
		return $this->belongsToMany('User', 'friends', 'friend_id', 'user_id')
			->wherePivot('accepted', '=', 1)
			->withPivot('accepted');
	}

	// accessor allowing you call $user->friends
	public function getFriendsAttribute() {
		if (!array_key_exists('friends', $this->relations)) {
			$this->loadFriends();
		}

		return $this->getRelation('friends');
	}

	protected function loadFriends() {
		if (!array_key_exists('friends', $this->relations)) {
			$friends = $this->mergeFriends();

			$this->setRelation('friends', $friends);
		}
	}

	protected function mergeFriends() {
		return $this->friendsOfMine->merge($this->friendOf);
	}

}
