<?php

$request = new Illuminate\Http\Request;

return [

	/*
		    |--------------------------------------------------------------------------
		    | Third Party Services
		    |--------------------------------------------------------------------------
		    |
		    | This file is for storing the credentials for third party services such
		    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
		    | default location for this type of information, allowing packages
		    | to have a conventional place to find your various credentials.
		    |
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'google_reCaptcha' => [
		'secret' => '6LdAAP8SAAAAALGwdg9ncAUAIW0Fteov3VcCgmDG',
	],

	'ses' => [
		'key' => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],

	'stripe' => [
		'model' => App\User::class,
		'key' => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	'facebook' => [
		'client_id' => '181933401931405',
		'client_secret' => '16c5488551be6f32e6689c9ff1c0bf6b',
		'redirect' => env('APP_URL') . '/auth/OAuth/facebook/callback',
	],

	'google' => [
		'client_id' => '415850758985-6u2ttqkqq80aomq6n5lrhaer5pitcf91.apps.googleusercontent.com',
		'client_secret' => 'Ad-9wub1t2xovgZOdA2Hukwz',
		'redirect' => env('APP_URL') . '/auth/OAuth/google/callback',
	],

];
