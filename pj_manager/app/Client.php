<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];

    public static $validate_rules = [
        'name'=>'required|unique:clients',
    ];
}
