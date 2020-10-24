<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

    public static $validate_rules = [
        'jobCode'=>'required',
        'name'=>'required',
        'period_id'=>'required',
        'branch_id'=>'required',
        'client_id'=>'required',
        'group_id'=>'required',
        'director'=>'required',
        'director_email'=>'required',
        'assigner'=>'required',
        'status_id'=>'required',
        'note'=>'',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class ,'branch_id');
    }

    public function client() {
        return $this->belongsTo(Client::class ,'client_id');
    }

    public function group() {
        return $this->belongsTo(Group::class ,'group_id');
    }

    public function status() {
        return $this->belongsTo(Status::class ,'status_id');
    }

    public function period() {
        return $this->belongsTo(Period::class ,'period_id');
    }

    public function projectCode() {
        return sprintf('%05d', $this->id);
    }
}
