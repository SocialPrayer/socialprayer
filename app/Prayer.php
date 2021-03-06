<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prayer extends Model {

	use SoftDeletes;

	protected $with = ['user', 'privacysetting'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'text',
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function privacysetting() {
		return $this->belongsTo('App\PrivacySetting');
	}

	public function prayedalong() {
		return $this->hasMany('App\PrayAlong')->where('prayed',1);
	}

	public function praylater() {
		return $this->hasMany('App\PrayAlong')->where('prayed',0);
	}

}
