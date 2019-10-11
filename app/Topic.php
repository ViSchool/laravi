<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Content;
use App\Subject;
use App\Unit;
use App\Status;
use Laravel\Scout\Searchable;


class Topic extends Model
{
	use Searchable;
    protected $fillable = ['topic_title','topic_img','subject_id'];

	public function subjects()
	{
		return $this->belongsToMany('App\Subject');
	}
	
	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}

	public function content()
	{
		return $this->hasMany(Content::class);
	}

	public function unit()
	{
		return $this->hasMany(Unit::class);
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function status()
	{
		return $this->belongsTo('App\Status');
	}

}
