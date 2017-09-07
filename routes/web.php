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

Route::get('/', 'TodolistController@getAll');
Route::post('/addList', 'ListController@addList');

Route::post('/addTodolist', 'TodolistController@addTodolist');
Route::get('/updateTodolist/{id}', 'TodolistController@updateTodolist');
Route::post('/deleteTodolist/{id}', 'TodolistController@deleteTodolist');


// In Progress
Route::post('/updateList', 'ListController@updateList');
Route::post('/deleteList', 'ListController@deleteList');
