<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = 'taskStatuses';

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
