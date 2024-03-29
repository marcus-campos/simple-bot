<?php


Route::group(['prefix' =>'app/marcus-campos/simple-bot', 'https' => true], function (){
    Route::group(['prefix' => 'bot'], function () {
        Route::get('webhook', 'SimpleBot\App\Controllers\BotController@subscribe');
        Route::post('webhook', 'SimpleBot\App\Controllers\BotController@receiveMessage');
    });

    Route::get('/', function () {
        return view('marcus-campos/simple-bot::answers');
    });

    Route::match(['get', 'post'], 'hook', 'SimpleBot\App\Controllers\BotController@handle')->name('hook');
});