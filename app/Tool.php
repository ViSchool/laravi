<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    public function devices() 
    {
    	return $this->belongsToMany('App\Device');
    }
    
    public function contents() 
    {
    	return $this->hasMany('App\Content');
    }

}
