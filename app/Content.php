<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\Topic;
use App\Portal;
use Laravel\Scout\Searchable;
use App\question;

class Content extends Model
{
	use Searchable;
	
	protected $guarded = [];
	
    public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
	
	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}
	
	public function questions()
	{
		return $this->hasMany(question::class);
	}
	
	public function devices()
	{
		return $this->belongsToMany(Device::class);
	}

	public function tool()
	{
		return $this->belongsTo(Tool::class);
	}
	
	public function portal()
	{
		return $this->belongsTo('App\Portal');
	}

	public function reviews()
	{
		return $this->hasMany('App\Review');
	}
	
	public function mistakes()
	{
		return $this->hasMany('App\Mistake');
	}

	public function type()
	{
		return $this->belongsTo('App\Type');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function status()
	{
		return $this->belongsTo('App\Status');
	}

	public function blocks()
	{
		return $this->hasMany('App\Block');
	}
	
	public static function parse_yturl($url) 
	{
	$pattern = '#^(?:https?://)?(?:www\.|m\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	preg_match($pattern, $url, $matches);
	return isset($matches[1]) ? $matches[1] : false;
	}
	
	public static function parse_vimeo($url) 
	{
	$apiurl = 'https://vimeo.com/api/oembed.json?url=' . $url;
	$JSON =file_get_contents($apiurl);
	$data = json_decode($JSON);
	return $data;
	}
	
	public static function parse_h5p($url) 
	{
	$pattern = '#^(?:https?://)?(?:www\.|m\.)?(?:h5p.org/node/|h5p.org/h5p/embed/)([\d]{5,7})#';
	preg_match($pattern, $url, $matches);
	return isset($matches[1]) ? $matches[1] : false;
	}
}
