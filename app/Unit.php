<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Unit extends Model
{
	use Searchable;
    public function series()
	{
		return $this->belongsToMany('App\Serie');
	}
    
    public function reviews()
	{
		return $this->hasMany('App\Review');
	}
	
	public function blocks()
	{
		return $this->hasMany('App\Block');
	}
	
	public function mistakes()
	{
		return $this->hasMany('App\Mistake');
	}
	
	public function subject()
	{
		return $this->belongsTo('App\Subject');
	}
	
	public function topic()
	{
		return $this->belongsTo('App\Topic');
	}
	
}
