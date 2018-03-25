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

Route::get('/messages', 'MessagesController@search');

Auth::routes();

Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@facebookCallback');
Route::get('/auth/github', 'SocialAuthController@github');
Route::get('/auth/github/callback', 'SocialAuthController@githubCallback');
Route::get('/auth/twitter', 'SocialAuthController@twitter');
Route::get('/auth/twitter/callback', 'SocialAuthController@twitterCallback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::get('/{username}', 'UsersController@show');
Route::get('/{username}/follows', 'UsersController@follows');
Route::get('/{username}/followers', 'UsersController@followers');

Route::group(['middleware' => 'auth'], function (){
  Route::post('messages/create', 'MessagesController@create');

  Route::post('/{username}/follow', 'UsersController@follow');
  Route::post('/{username}/unfollow', 'UsersController@unfollow');

  Route::post('/{username}/dms', 'UsersController@sendPrivateMessage');
  Route::get('/conversations/{conversation}', 'UsersController@showConversation');

  route::get('/api/notifications', 'UsersController@notifications');
  route::get('/api/readNotification/{notification}', 'UsersController@readNotification');
  route::get('/api/readNotifications', 'UsersController@readNotifications');
  route::get('/api/deleteNotifications', 'UsersController@deleteNotifications');
  route::get('/api/deleteNotification/{notification}', 'UsersController@deleteNotification');

});

Route::get('/api/message/{message}/responses', 'MessagesController@responses');
