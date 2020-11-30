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

//SSL
if(config('app.env') === 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return 'topページ';
})->name('top');

Route::get('/home', function () {
    return 'homeページ';
})->name('home');

Auth::routes();

Route::get('/memo', 'MemoController@index')->name('memo');
Route::post('/memo', 'MemoController@store')->name('memo.store');
Route::get('/memo/get', 'MemoController@get')->name('memo.get');

Route::get('/todo', 'TodoController@index')->name('todo');
Route::post('/todo', 'TodoController@store')->name('todo.store');
Route::get('/todo/get', 'TodoController@get')->name('todo.get');
Route::put('/todo/{id}', 'TodoController@update')->name('todo.update');
