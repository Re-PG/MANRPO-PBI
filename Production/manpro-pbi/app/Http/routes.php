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

Route::get('/','Pages@index');

Route::get('publication','PublicationController@index');

Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);

Route::get('/test',function(){
  return view('static.home-layouted');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get ('/admin', 'AdminController@index');
