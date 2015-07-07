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

Route::get('/'          , function () {return view('staticPages.welcome');});
Route::get('/hello'     , function () {return 'hello world';});
Route::get('/contact'   , 'StaticPageController@contact');
Route::get('/about'     , 'StaticPageController@about');
Route::get('/people'    , 'StaticPageController@people');
