<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PrayerController;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => ['guestView']]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// $dbt = new BibleAPI(null, null, 'json');
		// $volumes = $dbt->getLibraryVolume(null, null, 'text', null, null, 'ENG');
		// $volumes = json_decode($volumes);
		$prayers = new PrayerController;
		return view('prayers/list', 
			[
				'prayers' => $prayers->index(), 
				'privacysettings' => $prayers->getPrivacySettings(), 
				'prayersForLater' => $prayers->prayersForLater(),
				'createPrayer' => 1
			]
		);

	}

	public function guestView() {
		$prayers = new PrayerController;
		return view('welcome', ['prayers' => $prayers->guest()[0], 'privacysettings' => $prayers->guest()[1]]);
	}
}
