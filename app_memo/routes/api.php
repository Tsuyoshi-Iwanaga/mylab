<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/logout', function(Request $request) {
        Auth::guard('web')->logout();
        return ['result' => true];
    });
});

Route::post('/login', function(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if(Auth::attempt($credentials)) {
        return ['result' => true];
    } else {
        return response(['message' => 'ユーザーが見つかりません。'], 422);
    }
});

Route::post('/register', function(Request $request) {
    return \App\User::create([
        'name' => 'testUser01',
        'email' => 'fukuoka@test.com',
        'password' => Hash::make('fukuoka2020'),
    ]);
});