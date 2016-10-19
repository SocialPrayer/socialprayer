<?php

namespace App\Http\Controllers;

use App\Notifications\FriendPrayed;
use Auth;
use Illuminate\Http\Request;
use \App\PrayAlong as PrayAlong;
use \App\Prayer as Prayer;
use \App\PrivacySetting as PrivacySetting;

class PrayerController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => ['guest']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$prayers = Prayer::orderBy('created_at', 'desc')
			->with('privacysetting')
			->with('user')
			->with('prayalong')
			->whereIn('privacy_setting_id', [2, 3, 4])
			->orWhere(['user_id' => Auth::id(), 'privacy_setting_id' => '1'])
			->get();
		//->paginate(5);

		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();

		return view('prayers/list', ['prayers' => $prayers, 'privacysettings' => $privacysettings]);
	}

	public function guest() {
		$prayers = Prayer::orderBy('created_at', 'desc')
			->with('privacysetting')
			->with('user')
			->with('prayalong')
			->where('user_id', 0)
			->paginate(5);

		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();

		return [$prayers, $privacysettings];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if ($request->privacy != 0) {
			$prayer = new Prayer;
			$prayer->text = $request->prayerText;
			if ($request->privacy != 4) {
				$prayer->user_id = Auth::id();
			} else {
				$prayer->user_id = 0;
			}
			$prayer->privacy_setting_id = $request->privacy;
			$prayer->save();
		}

		if ($request->privacy > 1 && $request->privacy != 4) {
			$friends = Auth::user()->friends;
			foreach ($friends as $friend) {
				$friend->notify(new FriendPrayed($friend->id, $prayer->id));
			}
		}

		flash('Your prayer has been submitted up to God!', 'success');
		return redirect('/home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$prayer = Prayer::with('privacysetting')
			->with('user')
			->with('prayalong')
			->where('prayers.id', $id)
			->get();

		return view('prayers/show', array('prayer' => $prayer[0], 'solo' => true));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function prayAlong($prayerid) {
		$prayalong = new PrayAlong;
		$prayalong->prayer_id = $prayerid;
		$prayalong->user_id = Auth::id();
		$prayalong->save();

		$prayalongcount = PrayAlong::where('prayer_id', $prayerid)->count();

		if ($prayalongcount == 1) {
			$returntext = "You prayed along";
		} elseif ($prayalongcount == 2) {
			$returntext = "You and 1 person prayed along";
		} else {
			$returntext = "You and " . $prayalongcount . " people prayed along";
		}

		return $returntext;
	}
}
