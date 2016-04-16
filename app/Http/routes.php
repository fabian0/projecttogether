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

Route::post('/login', 'UserController@loginUser');

Route::get('/users', 'UserController@getAll');
Route::get('users/{id}','UserController@getUserById');
Route::post('/users', 'UserController@createUser');
Route::post('/users/{id}/skills', 'UserController@addSkillToUser');

Route::get('/ideas/latest', 'IdeaController@getLatest');
Route::get('/ideas/category/{id}', 'IdeaController@getIdeaByCategory');
Route::post('/ideas', 'IdeaController@createIdea');
Route::post('/ideas/{id}/skills', 'IdeaController@addSkillToIdea');


