<?php
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/
	
	Route::get('/', function (){ 
		$homeTitle = 'DraftDaily API Application';
		return view('homepage',array('homeTitle'=>$homeTitle));
	});
	Route::get('contact-us', function () { 
		$homeTitle = 'Contact Us';
		return view('contactus',array('homeTitle'=>$homeTitle));
	});
	Route::get('about-us', function () { 
		$homeTitle = 'About us';
		return view('aboutus',array('homeTitle'=>$homeTitle));
	});
	Route::get('what-we-do', function () { 
		$homeTitle = 'What we do';
		return view('whatwedo',array('homeTitle'=>$homeTitle));
	});
	Route::get('what-we-are', function () { 
		$homeTitle = 'What we are';
		return view('whatweare',array('homeTitle'=>$homeTitle));
	});
    Route::get('api-details', function () { 
		$homeTitle = 'API Details';
		return view('api-details',array('homeTitle'=>$homeTitle));
	});
	Route::get('dfscoin', function () { 
		$homeTitle = 'DFSCoin';
		return view('dfscoin',array('homeTitle'=>$homeTitle));
	});
	Auth::routes();
	
	Route::get('/home', 'HomeController@index');
	Route::GET('/fetch-state','HomeController@fetchState');
	Route::GET('/fetch-city','HomeController@fetchCity');
	Route::GET('user/login','User\LoginController@showLoginForm')->name('user.login');
	Route::GET('user/register','User\RegisterController@showRegisterForm')->name('user.register');
	Route::POST('user/login','User\LoginController@login');
	Route::POST('user/register/process','User\RegisterController@create')->name('user.registrationprocess');
	Route::GET('/thank-you','User\RegisterController@Thankyou')->name('thankyou');
	Route::GET('user/logout','User\LoginController@logout')->name('user.logout');
	Route::POST('user-password/email','User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
	Route::GET('user-password/forgot','User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
	Route::POST('user-password/reset','User\ResetPasswordController@reset');
	Route::GET('user-password/reset/{token}','User\ResetPasswordController@showResetForm')->name('user.password.reset');



	Route::group(['middleware' => ['auth:appuser'], 'prefix' => 'user'], function()
	{	
		/* Dashboard for User */
		Route::GET('/home','User\UserController@index')->name('user.home');
	   
		Route::GET('/profile','User\UserController@profile')->name('user.profile');
		Route::POST('/profile','User\UserController@Editprofile')->name('user.profile');
		  
		Route::GET('application','User\UserController@AppList')->name('AppList');
	   
		Route::GET('new-app','User\UserController@AppNew')->name('AppNew');
		Route::POST('new-app-process','User\UserController@PostAppNew')->name('PostAppNew');
		
		Route::POST('delete-app','User\UserController@DeleteApp')->name('DeleteApp');
		Route::GET('edit-App/{id}','User\UserController@AppEdit')->name('EditAppGet');
	   
		Route::POST('edit-App/{id}','User\UserController@AppPostEdit')->name('EditApp');
		Route::GET('view-app/{id}','User\UserController@viewAppDetail')->name('ViewApp'); 
		
		Route::POST('change-appId','User\UserController@changeAppId')->name('ChangeAppId');
		
		
		Route::GET('documentation','User\UserController@showDocumentation')->name('documentation'); 
		
	});
	
	/************************************Testing purpose***********************************/
	Route::get('test', function () { 
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    echo $ip;




	});