<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Differentiation extends Model
{
    public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function blocks()
	{
		return $this->hasMany('App\Block');
	}
}
