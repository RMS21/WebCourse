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

Route::group(['middleware' => ['web']], function () {
    Route::get('/login', [
    'uses' => 'UserController@getLogin',
    'as' => 'get_login'
  ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'get_logout'
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

    Route::get('/{category?}', [
          'uses' => 'UserController@getHome',
          'as' => 'get_home'
        ]);

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/create/news', [
      'uses' => 'ReporterController@getCreateNews',
      'as' => 'get_create_news'
  ]);
        Route::post('/create/news', [
      'uses' => 'ReporterController@postCreateNews',
      'as' => 'post_create_news'
  ]);

        Route::get('like/news/{news_id}', [
    'uses' => 'UserController@getLikeNews',
    'as' => 'get_like_news'
  ]);
        Route::post('comment/news', [
    'uses' => 'UserController@postCommentNews',
    'as' => 'post_comment_news'
  ]);

  Route::get('delete/news/{news_id}', [
    'uses' => 'AdminController@getDeleteNews',
    'as' => 'get_delete_news'
  ]);
    });
});
