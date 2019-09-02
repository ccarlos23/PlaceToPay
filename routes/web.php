<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('formpayment');
});
Route::post('/resumen', 'PlacetoPlayController@resumen');
Route::post('/pay', 'PlacetoPlayController@payment');
Route::any('/list', 'PlacetoPlayController@getList');
Route::any('/status/{requestid}', 'PlacetoPlayController@getstatus');
Route::any('/reference/{requestid}', 'PlacetoPlayController@getstatus');
