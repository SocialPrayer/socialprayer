<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/', 'HomeController@guestView');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/privacy-policy', function () {
	return view('legal/privacypolicy');
});
Route::get('/terms-and-conditions', function () {
	return view('legal/termsandconditions');
});

Route::get('/user/removefriend/{friendid}', 'UserController@removeFriend');

Route::get('/user/addfriend/{friendid}', 'UserController@addFriendRequest');

Route::get('/user/invite-friends/', 'UserController@inviteFriendsForm');

Route::post('/user/invite-friends', 'UserController@inviteFriendsSend');

Route::get('/user/acceptfriend/{friendshipid}', 'UserController@acceptFriendRequest');

Route::resource('/prayer', 'PrayerController');

Route::resource('/prayers/user', 'PrayerController@fromUser');

Route::resource('/user/profile', 'UserProfileController');

Route::post('/user/profile/{id}', 'UserProfileController@update');

Route::get('/prayer/pray-along/{prayerid}', 'PrayerController@prayAlongNow');

Route::get('/prayers/prayers-for-later', 'PrayerController@prayersForLaterView');

Route::get('/prayer/pray-along/later/{prayerid}', 'PrayerController@prayAlongLater');

Route::get('auth/OAuth/{driver}', 'Auth\SocialiteAuthController@redirectToProvider');

Route::get('auth/OAuth/{driver}/callback', 'Auth\SocialiteAuthController@handleProviderCallback');
