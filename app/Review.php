<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function content()
	{
		return $this->belongsTo('App\Content');
	}
	
	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}
}
