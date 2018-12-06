<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function portals()
	{
		return $this->belongsToMany('App\Portal');
	}
	
	public function contents()
	{
		return $this->hasMany('App\Content');
	}
	
}
