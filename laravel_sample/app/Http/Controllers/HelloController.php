<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
    public function index(Request $req, Response $res) {
        $html = "<html><head></head><body><h3>リクエスト</h3><pre>{$req}</pre><h3>レスポンス</h3><pre>{$res}</pre><h3>リクエストのメソッド</h3><p>{$req->url()}</p><p>{$req->fullUrl()}</p><p>{$req->path()}</p></body></html>";
        $res->setContent($html);
        return($res);
    }
    // public function __invoke() {
    //     return "This is single ActionController";
    // }
}
