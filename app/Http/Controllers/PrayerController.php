<?php

namespace App\Http\Controllers;

use App\Notifications\FriendPrayed;
use Auth;
use Illuminate\Http\Request;
use App\PrayAlong as PrayAlong;
use App\Prayer as Prayer;
use App\PrivacySetting as PrivacySetting;
use Illuminate\Support\Facades\Response;
use App\Events\NewPrayer;
use App\Events\PrayedAlong;

class PrayerController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware('auth', ['except' => ['guest']]);
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
			->with('prayedalong')
			->whereIn('privacy_setting_id', [2, 3, 4])
			->orWhere(['user_id' => Auth::id(), 'privacy_setting_id' => '1'])
			->get();
		//->paginate(5);

		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();


		return $prayers;
		//return view('prayers/list', ['prayers' => $prayers, 'prayerslater' => $prayerslater, 'privacysettings' => $privacysettings]);
	}

	public function getPrivacySettings() {
		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();
		return $privacysettings;
	}

	public function guest() {
		$prayers = Prayer::orderBy('created_at', 'desc')
			->with('privacysetting')
			->with('user')
			->with('prayedalong')
			->where('user_id', 0)
			->get();
		//->paginate(5);

		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();

		return [$prayers, $privacysettings];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fromUser($userid) {
		$getUser = \App\User::find($userid);

		$prayers = Prayer::orderBy('created_at', 'desc')
			->with('privacysetting')
			->with('user')
			->with('prayedalong')
			->whereIn('privacy_setting_id', [2, 3, 4])
			->where('user_id',$userid)
			->paginate(5);

		$privacysettings = PrivacySetting::orderBy('id', 'asc')->get();

		return view('prayers/list', 
			[
				'prayers' => $prayers, 
				'privacysettings' => $privacysettings,
				'prayersForLater' => 0,
				'createPrayer' => 0,
				'titleHeader' => $getUser->name . "'s Prayers"
			]
		);
		return view('prayers/list', ['prayers' => $prayers, 'privacysettings' => $privacysettings]);
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

		$newprayer = Prayer::with('privacysetting')
			->with('user')
			->with('prayedalong')
			->find($prayer->id);

		event(new NewPrayer($newprayer));

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
			->with('prayedalong')
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

	public function prayAlongNow($prayerid) {
		$prayalong = new PrayAlong;
		$prayalong->prayer_id = $prayerid;
		$prayalong->user_id = Auth::id();
		$prayalong->prayed = 1;
		$prayalong->save();

		$prayalongcount = PrayAlong::where('prayer_id', $prayerid)->count();

		if ($prayalongcount == 1) {
			$returntext = "You prayed along";
		} elseif ($prayalongcount == 2) {
			$returntext = "You and 1 person prayed along";
		} else {
			$returntext = "You and " . $prayalongcount . " people prayed along";
		}

		event(new PrayedAlong($prayerid, $prayalongcount));

		return $returntext;
	}

	public static function prayersForLater($id = null) {
		if ($id == null) {
			$id = Auth::id();
		}
		$prayersForLater = Prayer::orderBy('prayers.created_at', 'desc')
			->with('privacysetting')
			->with('user')
			->with('prayedalong')
			->join('pray_along', 'pray_along.prayer_id', '=', 'prayers.id')
			->where('pray_along.user_id', $id)
			->where('prayed',0)
			->get(['prayers.*']);
			return $prayersForLater;
	}

	public function prayersForLaterView() {
			return view('prayers/list', 
				[
					'prayers' => $this->prayersForLater(), 
					'prayersForLater' => $this->prayersForLater(), 
					'privacysettings' => $this->getPrivacySettings(),
					'createPrayer' => 0,
					'titleHeader' => 'Saved Prayers For Later'
				]
			);
	}

	public function prayAlongLater($prayerid) {
		$prayalong = new PrayAlong;
		$prayalong->prayer_id = $prayerid;
		$prayalong->user_id = Auth::id();
		$prayalong->prayed = 0;
		$prayalong->save();
	}

	public function prayAlongLaterNow($prayAlongID) {
		$prayalong->find($prayAlongID);
		$prayalong->prayed = 1;
		$prayalong->save();
	}
}
