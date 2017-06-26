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

Route::group(['middleware' => ['web']], function(){

  Route::get('/', [
    'uses' => 'UserController@getLogin',
    'as' => 'get_login'
  ]);

  Route::get('/login', [
    'uses' => 'UserController@getLogin',
    'as' => 'get_login'
  ]);

  Route::post('/login', [
    'uses' => 'UserController@postLogin',
    'as' => 'post_login'
  ]);

  Route::get('/register', [
    'uses' => 'UserController@getRegister',
    'as' => 'get_register'
  ]);

  Route::post('/register', [
    'uses' => 'UserController@postRegister',
    'as' => 'post_register'
  ]);

  Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [
      'uses' => 'UserController@getHome',
      'as' => 'get_home'
    ]);
  });

});
