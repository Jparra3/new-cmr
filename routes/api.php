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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/customers/{customer}/update','CustomerController@update');
Route::post('/customers/{customer}/delete','CustomerController@destroy');

Route::resource('/customers','CustomerController');

Route::post('/transactions/{transaction}/update','TransactionsController@update');
Route::post('/transactions/{transaction}/delete','TransactionsController@destroy');
Route::resource('/transactions','TransactionsController');
