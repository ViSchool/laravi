<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Content;
use App\Subject;
use App\Unit;


class Topic extends Model
{
    protected $fillable = ['topic_title','topic_img','subject_id'];

	public function subjects()
	{
		return $this->belongsToMany('App\Subject');
	}
	
	public function content()
	{
		return $this->hasMany(Content::class);
	}

	public function unit()
	{
		return $this->hasMany(Unit::class);
	}

}
