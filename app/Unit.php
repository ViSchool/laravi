<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laracasts\Presenter\PresentableTrait;
use Carbon;


class Unit extends Model
{
	use PresentableTrait;
	protected $presenter = 'App\Presenters\datePresenter';
	
	use Searchable;
   public function serie()
	{
		return $this->belongsTo('App\Serie');
	}
    
    public function reviews()
	{
		return $this->hasMany('App\Review');
	}
	
	public function blocks()
	{
		return $this->hasMany('App\Block');
	}
	
	public function tasks()
    {
        return $this->hasMany('App\Task');
	 }
	
	 public function jobs()
    {
        return $this->hasMany('App\Job');
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

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function status()
	{
		return $this->belongsTo('App\Status');
	}

	public function featured()
	{
		return $this->belongsTo('App\Featured');
	}

	public static function prettyDate($date) 
	{
		return $date->diffForHumans();
	}
}
