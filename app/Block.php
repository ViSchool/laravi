<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function unit()
	{
		return $this->belongsTo('App\Unit', 'unit_id');
	}
	
	public function differentiation()
	{
		return $this->belongsTo('App\Differentiation');
	}

	public function content()
	{
		return $this->belongsTo('App\Content');
	}
}
