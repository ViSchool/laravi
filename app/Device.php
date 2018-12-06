<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function content() 
    {
    	return $this->belongsToMany('App\Content');
    }
    
    public function tools() 
    {
    	return $this->belongsToMany('App\Tool');
    }	
}
