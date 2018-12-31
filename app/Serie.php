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
		return $this->belongsToMany(Unit::class);
	}
	
}
