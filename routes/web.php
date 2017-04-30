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
    Route::resource('user', 'UserController', [
        'only' => ['update', 'destroy'],
        'names' => ['update' => 'update.admin', 'destroy' => 'destroy.admin']
    ]);
    Route::post('/register', 'Auth\RegisterController@register');

    Route::get('/', 'AdminController@index');
    Route::get('/moderators', 'AdminController@moderators');

    Route::resource('rubrics', 'RubricsController', [
        'only' => ['index', 'store', 'show', 'destroy', 'edit', 'update'],
        'names' => [
            'index' => 'admin.rubrics', 'store' => 'store.rubric', 'show' => 'show.rubric',
            'destroy' => 'destroy.rubric', 'edit' => 'edit.rubric', 'update' => 'update.rubric'
        ]
    ]);
    Route::get('rubrics/{rubric}/delete-questions', 'RubricsController@deleteQuestions');

    Route::get('questions/{id}/block', 'QuestionsController@block');
    Route::get('questions/{id}/unblock', 'QuestionsController@unblock');

    Route::get('new-questions', 'QuestionsController@newQuestions');
    Route::get('block-questions', 'QuestionsController@blockQuestions');

    Route::resource('questions', 'QuestionsController', [
        'only' => ['show', 'edit', 'update', 'destroy'],
        'names' => ['show' => 'show.question', 'edit' => 'edit.question', 'update' => 'update.question', 'destroy' => 'destroy.question']
    ]);
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'FaqController@main');
Route::get('/new-question', 'FaqController@getRubricForCreate');


Route::resource('/new-question/create', 'QuestionsController', ['only' => ['store'], 'names' => ['store' => 'create.question']]);

Route::group(array('prefix' => '{rubric}'), function () {
    Route::get('/', 'FaqController@rubric');
    Route::get('/new-question', 'FaqController@create');
    Route::get('/{question}', 'FaqController@question');
});


