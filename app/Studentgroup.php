<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentgroup extends Model
{
    public function students()
	{
		return $this->hasMany('App\Student');
    }

    public function user()
	{
		return $this->belongsTo('App\User');
    }
}
