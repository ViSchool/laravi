<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'done_date',
    ];
    
    
    public function results()
    {
        return $this->hasMany('App\Result');
    }

    public function taskStatus()
    {
        return $this->belongsTo('App\TaskStatus', 'taskStatus_id');
    }

    public function interaction()
    {
        return $this->belongsTo('App\Interaction');
    }

    public function block()
    {
        return $this->belongsTo('App\Block');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function teacher()
    {
        return $this->hasOneThrough('App\User', 'App\Student');
    }

    public function studentgroup()
    {
        return $this->belongsTo('App\Studentgroup');
    }

}


