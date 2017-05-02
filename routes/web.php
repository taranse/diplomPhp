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


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('user', 'UserController', [
        'only' => ['update', 'destroy'],
        'names' => ['update' => 'update.admin', 'destroy' => 'destroy.admin']
    ]);

    Route::resource('questions', 'QuestionController', [
        'only' => ['show', 'edit', 'update', 'destroy'],
        'names' => ['show' => 'show.question', 'edit' => 'edit.question', 'update' => 'update.question', 'destroy' => 'destroy.question']
    ]);

    Route::resource('rubrics', 'RubricController', [
        'only' => ['index', 'store', 'show', 'destroy', 'edit', 'update'],
        'names' => [
            'index' => 'admin.rubrics', 'store' => 'store.rubric', 'show' => 'show.rubric',
            'destroy' => 'destroy.rubric', 'edit' => 'edit.rubric', 'update' => 'update.rubric'
        ]
    ]);

    Route::post('/register', 'Auth\RegisterController@register');

    Route::get('/', 'AdminController@index');
    Route::get('/moderators', 'AdminController@moderators');

    Route::get('rubrics/{rubric}/delete-questions', 'RubricController@deleteQuestions');

    Route::get('questions/{id}/block', 'QuestionController@block');
    Route::get('questions/{id}/unblock', 'QuestionController@unblock');

    Route::get('new-questions', 'QuestionController@newQuestions');
    Route::get('block-questions', 'QuestionController@blockQuestions');

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'FaqController@main');
Route::get('/new-question', 'FaqController@getRubricForCreate');


Route::get('/new-question/create', 'QuestionController@store')->name('create.question');

Route::group(array('prefix' => '{rubric}'), function () {
    Route::get('/', 'FaqController@rubric');
    Route::get('/new-question', 'FaqController@create');
    Route::get('/{question}', 'FaqController@question');
});


