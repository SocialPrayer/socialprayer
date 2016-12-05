<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\UserProfile;

class UserProfileController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$userProfile = UserProfile::where('user_id', $id)->with('user')->get();
		return view('users/profile/show', array('userProfile' => $userProfile));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$userProfile = UserProfile::where('user_id', $id)->first();
		return view('users/profile/edit', array('userProfile' => $userProfile));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$userProfile = UserProfile::find($id);
		$userProfile->email = $request->email;
		$userProfile->firstname = $request->firstname;
		$userProfile->lastname = $request->lastname;
		$userProfile->sex = $request->sex;
		$userProfile->marital_status = $request->marital_status;
		$userProfile->spouse_name = $request->spouse_name;
		$userProfile->save();

		$user = User::find($userProfile->user_id);
		$user->email = $userProfile->email;
		$user->name = $userProfile->firstname . ' ' . $userProfile->lastname;
		$user->save();

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
}
