<?php

namespace App;

use App\Topic;
use App\Content;
use App\Unit; 

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function contents()
	{
		return $this->hasMany(Content::class);
    }
    
    public function topics()
	{
		return $this->hasMany(Topic::class);
    }
    
    public function units()
	{
		return $this->hasMany(Unit::class);
	}

	public function series()
	{
		return $this->hasMany(Serie::class);
	}

	public static function admin_approvals() {
		return static::where('id', 2)->first();
	}
}
