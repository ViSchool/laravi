<?php

namespace App;
use App\Tag;
use App\Unit;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;


class Serie extends Model
{
	use Searchable;
	
	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
	
	public function units()
	{
		return $this->hasMany(Unit::class);
	}
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public static function prettyDate($date) 
	{
		return $date->diffForHumans();
	}

	public function status()
	{
		return $this->belongsTo('App\Status');
	}
}
