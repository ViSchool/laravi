<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['tag_name','tag_group'];
	
    public function contents()
	{
		return $this->belongsToMany('App\Content');
	}
	
	public function posts()
	{
		return $this->belongsToMany('App\Post');
	}
	
	public function series()
	{
		return $this->belongsToMany('App\Serie');
	}
	
	public static function syncTags($request) 
	{	    
       $tags= $request->tags;
        foreach ($tags as &$tag ) {
    		
        		if (substr($tag, 0, 1) === '@') //check if Tag array contains Tags with @
        		{
        			$cleanTag = substr($tag, 1); //if true: remove @-character and save new tag in the database
        			$newTag = new Tag;
        			$newTag->tag_name = $cleanTag;
        			$newTag->tag_group = "ohne";
        			$newTag->save();
        			$tag = $newTag->id;  //get new id from the Tags table
        		}
        	}
        	$tags[] = $tag; //save an array with old and new tags
        	return $tags;
	}
        
}
