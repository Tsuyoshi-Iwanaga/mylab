<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asign extends Model
{
    protected $guarded = ['id'];

    public static $validate_rules = [
        'asigner'=>'required',
        'projectId'=>'required',
        'worker'=>'required',
        'planedHours'=>'required',
        'actualHours'=>'required',
        'billableAmount'=>'required',
    ];
}
