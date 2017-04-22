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

Route::get('/admin', 'AdminController@index');
Route::get('/admin/moderators', 'AdminController@moderators');

Route::get('/', 'FaqController@main');
Route::get('/{rubric}', 'FaqController@rubric');
Route::get('/{rubric}/{question}', 'FaqController@question');

