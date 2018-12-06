<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mistake extends Model
{
    public function content()
    {
    	return $this->belongsTo('App\Content');
    }
    
    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }
    
    public static function admin_mistake() {
		return static::take(20)->get();
	}
}
