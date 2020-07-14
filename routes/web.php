<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('welcomepage');

Auth::routes();


Route::get('/myprofile', 'Postcontroller@myprofile')->name('myprofile');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addnewpost', 'Postcontroller@createpost')->name('add.newpost');
Route::get('/showposts', 'Postcontroller@showpost')->name('showposts');
Route::get('/search', 'Postcontroller@search')->name('search');

Route::get('delete-records','Postcontroller@index');
Route::get('delete/{id}','Postcontroller@deletelink')->name('deletelink');
