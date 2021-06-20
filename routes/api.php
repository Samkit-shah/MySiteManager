<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
Route::post('register_google', 'ApiController@register_google');
Route::post('login_google', 'ApiController@login_google');
//Pocket
Route::post('getevents', 'ApiController@getevents');
Route::delete('deleteevent/{event}', 'ApiController@deleteevent');
Route::post('getspent', 'ApiController@getspent');
Route::post('getearned', 'ApiController@getearned');
Route::post('addevent', 'ApiController@addevent');
Route::post('addearned', 'ApiController@addearned');
Route::post('addspent', 'ApiController@addspent');
Route::post('getallfromevent', 'ApiController@getallfromevent');
Route::post('editpocketnote', 'ApiController@editpocketnote');
Route::post('deletepocketnote', 'ApiController@deletepocketnote');
//Links
Route::get('getsavedlinks/{userid}', 'ApiController@getsavedlinks');
Route::post('addlink', 'ApiController@addlink');
Route::delete('deletelink/{link}', 'ApiController@deletelink');
