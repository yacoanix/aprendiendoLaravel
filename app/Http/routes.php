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
use App\Note;

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('notes', 'NotesController@listNotes')->middleware('auth');

Route::get('welcome', 'NotesController@welcome')->middleware('auth');

Route::post('notes', 'NotesController@store')->middleware('auth');

Route::get('notes/create', 'NotesController@create')->middleware('auth');

Route::get('notes/look/{note}', 'NotesController@show')->where('note', '[0-9]+')->middleware('auth');

Route::get('notes/del/{note}', 'NotesController@delete')->where('note', '[0-9]+')->middleware('auth');

Route::auth();

Route::get('/home', 'HomeController@index')->middleware('auth');
