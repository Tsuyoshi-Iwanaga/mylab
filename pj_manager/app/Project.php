<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public static $validate_rules = [
        'projectCode'=>'required',
        'jobCode'=>'required',
        'name'=>'required',
        'client'=>'required',
        'director'=>'required',
        'assigner'=>'required',
    ];
}
