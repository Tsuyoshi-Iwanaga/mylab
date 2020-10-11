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

Route::get('/', function () { return redirect('project'); });

//project
Route::get('/project', 'ProjectController@index')->name('project');
Route::post('/project', 'ProjectController@store')->name('project/store');
Route::get('/project/create', 'ProjectController@create')->name('project/create');
Route::get('/project/edit', 'ProjectController@edit')->name('project/edit');
Route::post('/project/update', 'ProjectController@update')->name('project/update');
Route::post('/project/delete', 'ProjectController@delete')->name('project/delete');

//client
Route::get('/client', 'ClientController@index')->name('client');
Route::post('/client/store', 'ClientController@store')->name('client/store');
Route::post('/client/delete', 'ClientController@delete')->name('client/delete');

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
