<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Subject extends Model
{
    protected $fillable = ['subject_title'];

	public function topics()
	{
		return $this->belongsToMany('App\Topic');
	}

	public function contents()
	{
		return $this->hasMany(Content::class);
	}

	public static function nav_sub() {
		return static::all();
	}
	
	public function portals()
	{
		return $this->belongsToMany('App\Portal');
	}

	public function units()
	{
		return $this->hasMany('App\Unit');
	}


	}
	
