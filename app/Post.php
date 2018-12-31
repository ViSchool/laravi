<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;
use Laravel\Scout\Searchable;

class Post extends Model
{
	use Searchable;
	protected $fillable = ['post_title','post_body'];
	
	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}
	
	public function admin()
	{
		return $this->belongsTo('App\Admin');
	}

	public static function get_five_posts()
	{	
	$posts = Post::orderBy('updated_at','desc')->limit(9)->get();
	foreach($posts as $post) {
		$max_length = 150;
		if (strlen($post->post_body) > $max_length)
		{
    		$offset = ($max_length - 3) - strlen($post->post_body);
    		$post->post_body = substr($post->post_body, 0, strrpos($post->post_body, ' ', $offset)) . '...';
   		};
		Carbon::setLocale('de');
   		};
	return $posts;
	}
}