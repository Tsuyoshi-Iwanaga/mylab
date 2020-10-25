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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create_token', function() {
    $user = \App\User::find(1);
    $token = $user->createToken('my-api-token');
    echo $token->plainTextToken;
});

Route::get('/spa', function() {
    return view('spa');
});
