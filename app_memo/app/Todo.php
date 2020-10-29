<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public static $rules = [
        'status' => 'required',
        'body' => 'required',
        'planed_time' => 'required',
        'actual_time' => 'required',
        'deadline' => 'required',
    ];

    public function status_label() {
        if($this->status === 1) {
            return '□';
        }
        if($this->status === 2) {
            return '✓';
        }
        return 'Error!';
    }
}
