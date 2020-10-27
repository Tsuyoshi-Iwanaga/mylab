<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $fillable = ['category_id'];

    public static $rules = [
        'category_id' => 'required',
        'title' => 'required',
        'body' => 'required',
    ];
}
