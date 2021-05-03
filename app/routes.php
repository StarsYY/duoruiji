<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//登录，注销
Route::get('/login', 'UserController@Login');
Route::post('/login', 'UserController@DoLogin');
Route::get('/logout', 'UserController@Logout');

//后台
Route::controller('/adm/user', 'UserController');
Route::controller('/adm/expert', 'ExpertController');
Route::controller('/adm/video', 'VideoController');
Route::get('/adm', 'UserController@adminIndex');

//前台
Route::controller('/conf', 'ConfController');
Route::controller('/expert', 'ExpertsController');
Route::controller('/review', 'ReviewController');
Route::controller('/', 'FrontController');
