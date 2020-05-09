<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $table = 'job_statuses';

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }
}
