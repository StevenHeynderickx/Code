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


Route::get('/jongeren' ,
    ['as'=>'listJongeren',
        'uses'=>'JongerenController@index']);

Route::get('/jongeren/create',
    ['as'=>'createJongere',
        'uses'=>'jongerenController@create']);

Route::get('/jongeren/read',
    ['as'=>'createJongere',
        'uses'=>'jongerenController@read']);

Route::get('/jongeren/{id}',
    ['as'=>'showJongereById',
        'uses'=>'jongerenController@show']);
