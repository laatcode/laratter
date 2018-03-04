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

Route::get('/', 'PagesController@index');
Route::get('/message/{message}', 'MessagesController@show');

Route::post('messages/create', 'MessagesController@create')->middleware('auth');

Auth::routes();

Route::get('/{username}', 'UsersController@show');
Route::get('/{username}/follows', 'UsersController@follows');
Route::get('/{username}/followers', 'UsersController@followers');
Route::post('/{username}/follow', 'UsersController@follow');
Route::post('/{username}/unfollow', 'UsersController@unfollow');
