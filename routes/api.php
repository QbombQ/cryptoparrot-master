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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/broadcast/price', 'FrontSubsystem\BroadcastController@broadcastPriceChange');

Route::get('/update-trades/{fromId}/{toId}', 'FrontSubsystem\ActionsController@updateTrades');

Route::post('/devices', 'FrontSubsystem\ActionsController@updateDevice');
Route::post('/exchanges/callback', 'TradeSubsystem\ExchangesPageController@exchangeCallback');

Route::post('/price-in-usd', 'TradeSubsystem\ActionsController@priceInUsd');
Route::get('/get-weekly-change', 'TradeSubsystem\ActionsController@getWeeklyChangeForEachPair');