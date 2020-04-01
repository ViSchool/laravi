<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    public function subjects()
	{
		return $this->belongsToMany('App\Subject');
	}
	
	public function contents()
	{
		return $this->hasMany('App\Content', 'portal_id');
	}
	
	public function types()
	{
		return $this->belongsToMany('App\Type');
	}
	

	public function subjects_filtered($chosen) 
	{
		return $this->belongsToMany('App\Subject')->wherePivotIn('subject_id', $chosen);
	}
}
