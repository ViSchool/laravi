<?php

namespace App;
use DateInterval;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public static function convertDuration($youtube_duration) 
    {
    	$duration = new DateInterval($youtube_duration);
    	$durationSeconds = $duration->i * 60 + $duration->s;
    	return $durationSeconds;
    }
    
    public static function getHeight($youtube_code) 
    {
    	$height_position = strpos($youtube_code, 'height');
    	$height = substr($youtube_code, $height_position+8, 5);
    	$height = str_replace('"', ' ', $height);
    	rtrim($height);
    	return ($height);
    }
    
    public static function getWidth($youtube_code) 
    {
    	$width_position = strpos($youtube_code, 'width');
    	$width = substr($youtube_code, $width_position+7, 5);
    	$width = str_replace('"', ' ', $width);
    	rtrim($width);
    	return ($width);
    }
}
