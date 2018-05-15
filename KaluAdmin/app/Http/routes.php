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

    //Routes for FB
    Route::post('get-user-by-fbid', 'RegisterController@getUserByFBID');

    //Routes send message audio without token
    Route::post('upload-audio', 'ConversationController@uploadAudio');

    //Routes for get authenticated users
    Route::group(['middleware' => 'jwt-auth'], function () {
      //Routes for get info of user
    	Route::post('get-user-details', 'RegisterController@getUserDetails');

      //Routes for messages
    	Route::post('send-message', 'ConversationController@sendMessage');
      Route::post('get-messages', 'ConversationController@getMessagesXUser');
      Route::post('send-audio-message', 'ConversationController@sendAudioMessage');
      Route::post('set-response-kalu', 'ConversationController@setResponseFromKalu');

      //Routes for transactions
      Route::post('add-transaction', 'TransactionController@addTransaction');
      Route::post('add-items-transaction', 'TransactionController@addItemsTransaction');

      //Routes for wallet
      Route::post('get-incomes-expenses-by-user', 'WalletController@getIncomesAndExpensesByUser');
      Route::post('get-expected-incomes-expenses-by-user', 'WalletController@getIncomesAndExpensesExpectedByUser');
      Route::post('get-category-details-by-user', 'WalletController@getDetailsCategoryByUser');
    });

});
