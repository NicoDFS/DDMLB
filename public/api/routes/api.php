<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	/* App Authonticaiton Here */

	Route::post('/v1/app/auth', 'V1\apiController@AppAuth');

	/* Get All Country */

	Route::post('/v1/get-country-list', 'V1\apiController@getCountryList');

	/* Get All Country */

	Route::post('/v1/get-state-list', 'V1\apiController@getStateList');

	/* Api for register account */

	Route::post('/v1/register-account', 'V1\apiController@registerAccount');

	/* Api for user login */

	Route::post('/v1/user-login', 'V1\apiController@login');

	/* Api for user login */

	Route::post('/v1/user-logout', 'V1\apiController@logout');

	/* Api for user login */

	Route::post('/v1/get-user-account-detail', 'V1\apiController@getUserAccountDetails');

	/* Api for user login */

	Route::post('/v1/get-sports', 'V1\apiController@getSports');

	/* Api for user login */

	Route::post('/v1/get-contest-type', 'V1\apiController@getContestType');

	/* Api for user login */

	Route::post('/v1/get-matches', 'V1\apiController@getMatches');

	/* Api for user login */

	Route::post('/v1/create-new-contest', 'V1\apiController@newContest');
	
	/* Api for get contest list */

	Route::post('/v1/get-contest', 'V1\apiController@getActiveContest');
	
	/* Api for filter-player */

	Route::post('/v1/get-filter-player', 'V1\apiController@filterPlayer');
	
	/* Api for save Lineup */

	Route::post('/v1/new-lineup', 'V1\apiController@saveLineup');

	/* Api for edit-lineup */

	Route::post('/v1/edit-lineup', 'V1\apiController@editLineup');
	
	/* Api for get-lineup-details */

	Route::post('/v1/get-lineup-details', 'V1\apiController@getLineupDetails');
	
	/* Api for remove-player */

	Route::post('/v1/remove-player', 'V1\apiController@removePlayerFromLineup');
	
	/* Api for add-player */

	Route::post('/v1/add-player', 'V1\apiController@addPlayerToLineup');
	
	/* Api for get-applicable-match */

	Route::post('/v1/get-applicable-match', 'V1\apiController@getApplicableMatch');
/***************** API routing end here ***************************/


