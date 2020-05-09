<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentgroup extends Model
{
    public function students()
	  {
		return $this->hasMany('App\Student');
    }

    public function tasks()
	  {
		return $this->hasMany('App\Task');
    }

    public function jobs()
	  {
		return $this->hasMany('App\Job');
    }

    public function user()
	{
		return $this->belongsTo('App\User');
    }
}
