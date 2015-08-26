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

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', 'PostsController@index');
Route::get('unionAll', 'PostsController@unionAll');

Event::listen('illuminate.query', function ($query) {
   var_dump($query);
});
