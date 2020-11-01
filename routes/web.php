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

// Auth::routes();
// for no verification
Auth::routes(['verify' => true]);

Route::get('auth/google', 'Auth\RegisterController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\RegisterController@handleGoogleCallback');



Route::get('/myprofile', 'PostController@myprofile')->name('myprofile');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addnewpost', 'PostController@createpost')->name('add.newpost');
Route::get('/showposts', 'PostController@showpost')->name('showposts');


Route::get('/searchposts', 'PostController@showpost')->name('searchpost');

Route::get('delete-records','PostController@index');
Route::get('deletelink/{id}','PostController@deletelink')->name('deletelink');


Route::get('/sharepost','Sharelink@sitemailsend')->name('sharepost');
Route::get('/downloadPDF/{id}','PostController@downloadPDF')->name('downloadpdf');
Route::get('/submitfeedback','FeedbackController@submitfeedback')->name('submitfeedback');




Route::get('/addnewnote', 'NotesController@addnotetodb')->name('addnewnote');
Route::get('/downloadPDFnotes/{id}','NotesController@downloadPDFofnotes')->name('downloadpdfofnotes');
Route::get('delete-notes','NotesController@index');
Route::get('deletenote/{id}','NotesController@deletenote')->name('deletenote');
Route::get('/shownotes', 'NotesController@shownotes')->name('shownotes');
Route::get('/addnote', 'NotesController@addnotespage')->name('addnotes');
Route::get('/sharemail','Sharelink@notemailsend')->name('sharenotesmail');
Route::get('editnote/{id}','NotesController@editnotedata')->name('editnote');
Route::get('updatenotedata/{id}','NotesController@updatenotedata')->name('updatenote');





Route::get('/showpocket','PocketController@showpocket' )->name('showpocket');
Route::post('/addevent','PocketController@addevent')->name('add.event');
Route::get('/eventdetails/{eventid}','PocketController@eventdetails')->name('eventdetails');
Route::post('/addearned/{eventid}','PocketController@addearned')->name('add.earned');
Route::post('/addspent/{eventid}','PocketController@addspent')->name('add.spent');

Route::get('/deleteevent/{eventid}','PocketController@deleteevent')->name('deleteevent');
