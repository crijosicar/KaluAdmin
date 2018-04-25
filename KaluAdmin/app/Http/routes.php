<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['api','cors'], 'prefix' => 'api'], function () {

    //Routes for register
    Route::post('register', 'RegisterController@register');

    //Routes for login
    Route::post('login', 'RegisterController@login');

    //Routes for get authenticated users
    Route::group(['middleware' => 'jwt-auth'], function () {
        //Routes for get info of user
    	Route::post('get-user-details', 'RegisterController@get_user_details');

        //Routes for messages
    	Route::post('send-message', 'ConversationController@sendMessage');
        Route::post('get-messages', 'ConversationController@getMessagesXUser');

    });

});
