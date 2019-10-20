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

//default Page
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/param/{param?}', function ($param='noParam') {
    return $param;
});

Route::get('/hello/', 'HelloController@index');
