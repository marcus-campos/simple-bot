<?php


Route::group(['prefix' =>'app/marcus-campos/simple-bot'], function (){
    Route::group(['prefix' => 'bot'], function () {
        Route::get('webhook', 'SimpleBot\App\Controllers\BotController@subscribe');
        Route::post('webhook', 'SimpleBot\App\Controllers\BotController@receiveMessage');
    });

    Route::get('/', function () {
        return view('marcus-campos/simple-bot::answers');
    });
});