<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrayAlong extends Model {
	protected $table = 'pray_along';

	public function prayer() {
		return $this->belongsTo('App\Prayer');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

}
