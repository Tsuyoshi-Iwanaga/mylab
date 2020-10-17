<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asign extends Model
{
    protected $guarded = ['id'];

    public static $validate_rules = [
        'project_id'=>'required',
        'is_manhours_defined'=>'required',
        'worker_id'=>'required',
        'office_id'=>'required',
        'billing_id'=>'required',
        'grade_id'=>'required',
        'planed_hours'=>'required',
        'actual_hours'=>'required',
        'billable_amount'=>'required',
    ];

    public function project() {
        return $this->belongTo(Project::class, 'project_id');
    }

    public function grade() {
        return $this->belongTo(Grade::class, 'grade_id');
    }

    public function worker() {
        return $this->belongTo(User::class, 'worker_id');
    }

    public function office() {
        $office_id = $this->office_id;
        switch($office_id) {
            case '1':
                return 'near';
                break;
            case '2':
                return 'TCID';
                break;
            case '3':
                return 'TCAP';
                break;
            case '4':
                return 'TCV';
                break;
        }
    }
}
