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


Route::group(array('prefix' => 'admin'), function () {
    Route::match(['PUT', 'PATCH'], '/update/{resource}', 'UserController@update');
    Route::get('/', 'UserController@index');
    Route::get('/moderators', 'UserController@moderators');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', 'FaqController@main');
Route::get('/{rubric}', 'FaqController@rubric');
Route::get('/{rubric}/{question}', 'FaqController@question');


