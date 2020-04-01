<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $table = 'featured';

    public function serie()
	{
		return $this->belongsTo('App\Serie');
    }
    
    public function unit()
	{
		return $this->belongsTo('App\Unit');
	}
}

