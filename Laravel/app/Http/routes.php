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

Route::get('/'          ,['as'=>'home','uses'=>'StaticPageController@home']);

Route::get('/hello'     , function () {return 'hello world';});
Route::get('/contact'   , 'StaticPageController@contact');
Route::get('/about'     , 'StaticPageController@about');
Route::get('/people'    , 'StaticPageController@people');



Route::get('/jongeren'  ,       ['as'=>'showJongeren',      'uses'=>'JongerenController@index']);
Route::get('/jongeren/create',  ['as'=>'createJongere',     'uses'=>'JongerenController@create']);
Route::get('/jongeren/read',    ['as'=>'readJongere',       'uses'=>'JongerenController@read']);
Route::get('/jongeren/{id}',    ['as'=>'showJongereById',   'uses'=>'JongerenController@show']);

Route::post('/jongeren' ,       ['as'=>'storeJongere',      'uses'=>'JongerenController@store']);

