---
title: Laravel 基本操作
published: 2020-09-23
---

## ルーティング

```
//HTML文字列を返す
Route::get('/', function(){
  return '<html></html>';
});

//ビューを返す
Route::get('/hello', function(){
  return view('hello.index');
});

//コントローラのアクションを実行する
Route::get('/hello02', 'hello@index');

//コントローラのデフォルトアクション(__invoke)を実行する
Route::get('/hello03', 'hello');

//ルートパラメータ(必須)
Route::get('/user/{id}', 'hello@hoge');

//ルートパラメータ(デフォルト)
//※コントローラのアクション側で引数にデフォルト値を用意する必要がある
Route::get('/user/{id?}', 'hello@hoge');
```

## コントローラー
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
}
```
## ビュー
```php
php artisan
```
## データベース
```php
php artisan
```
## artisanコマンド
```php
php artisan
```