<?php

namespace App;
use App\Tag;
use App\Unit;

use Illuminate\Database\Eloquent\Model;


class Serie extends Model
{
    public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
	
	public function units()
	{
		return $this->belongsToMany(Unit::class);
	}
	
}
