<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function units()
	{
		return $this->belongsTo('App\Unit');
	}
	
	public function differentiation()
	{
		return $this->belongsTo('App\Differentiation');
	}
}
