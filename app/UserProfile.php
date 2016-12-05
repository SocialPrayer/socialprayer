<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {
	protected $fillable = [
		'firstname', 'lastname', 'email', 'user_id'
	];
	public function user() {
		return $this->belongsTo('App\User');
	}
}
