<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Topic;
use App\Content;
use Breadcrumbs;
use App\Icon;
use App\Post;
use App\Video;
use App\Unit;
use App\Block;
use App\Review;
use App\question;

class VischoolController extends BaseController

 

{
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
	
	$subjects = Subject::nav_sub();
	$posts = Post::get_five_posts(); 
	return view('vischool', compact('subjects','posts'));
	}
	
	public function subjects_index() {
	
	$subjects = Subject::all();
	return view('frontend.subjects.index', compact('subjects'));
	}
	
	public function subject_show ($id) {
	$subject = Subject::find($id);
    return view('frontend.subjects.subject_topics', compact('subject','today'));
	} 
	

	public function topics_index() {
	return view('frontend.topics.index', compact('topics'));
	}
	
	public function topic_show($id) {
	
	$topic = Topic::find($id);
	/* $contents = Content::where('topic_id',18)->with('reviews')->get()->sortBy(function($content){
		return $content->reviews->count();
	}); */
	$contents = Content::where('topic_id',$id)->orderBy('updated_at','desc')->paginate(15); 
	$units = Unit::where('topic_id',$id)->orderBy('updated_at','desc')->paginate(15);
	    return view('frontend.topics.topic_contents', compact('contents','topic','units','average_score'));
	} 


	public function contents_index() {
	$contents = Content::all();
	return view('frontend.contents.index', compact('contents'));
	}
	
	//Temporary during development
	public function content_show($id) 
	
	{
	$content = Content::find($id);
	$breadcrumbs = Breadcrumbs::addCrumb('Startseite', '/');
	$breadcrumbs = Breadcrumbs::addCrumb($content->subject->subject_title , '/subjects/'. $content->subject->id);
	$breadcrumbs = Breadcrumbs::addCrumb($content->topic->topic_title,'/topic/'. $content->topic->id);
	$breadcrumbs = Breadcrumbs::addCrumb($content->content_title,'/content/'. $content->id);
	//calculate aspect ratio for Video
	if ($content->tool_id == 1) {
	$video=Video::where('content_id',$content->id)->first();
	$aspect_calc = $video->video_maxWidth/$video->video_maxHeight;
	if($aspect_calc < 1.5) 
	$aspect_ratio = "4by3";	
	else (
	$aspect_ratio = "16by9"
	);	
	};
	//get reviews
	$reviews = Review::where('content_id',$id)->get();
	$average_score = $reviews->avg('overall_score');
	
	//get random question
	
	$questions = Question::where('content_id',$id)->get()->isNotEmpty();
	if($questions == true){
	$question = Question::where('content_id',$id)->get()->random();
	$finalResult = 0;
	$correctAnswers = 0;
	if (isset($question->answer1)) {
	$finalResult ++;
		if($question->solution1 == 1){
			$correctAnswers++;
		}
	}
	if (isset($question->answer2)) {
	$finalResult ++;
		if($question->solution2 == 1){
			$correctAnswers++;
		}
	}
	if (isset($question->answer3)) {
	$finalResult ++;
		if($question->solution3 == 1){
			$correctAnswers++;
		}
	}
	if (isset($question->answer4)) {
	$finalResult ++;
		if($question->solution4 == 1){
			$correctAnswers++;
		}
	}
	if (isset($question->answer5)) {
	$finalResult ++;
		if($question->solution5 == 1){
			$correctAnswers++;
		}
	}
	}
	else {
		$question = null;
		$finalResult = null;
	}
	return view('frontend.contents.show_contents', compact('breadcrumbs','content','aspect_ratio', 'reviews','average_score','question','finalResult','correctAnswers'));
	}



	public function units_index() {
	return view('frontend.units.index');
	/* $units = Unit::all();
	return view('frontend.units.index', compact('units')); */
	}
	
	public function units_topic($id) {
	$topic = Topic::find($id);
	$units = Unit::where('topic_id','=',$id)->get();
	//get reviews
	$reviews = Review::where('content_id',$id)->get();
	$average_score = $reviews->avg('overall_score');
	return view('frontend.units.units_topic', compact('topic','units','average_score'));
	/*$units = Unit::all();
	return view('frontend.units.index', compact('units')); */
	}
	
	public function unit_show($id) {
	$unit = Unit::find($id);
	$blocks = $unit->blocks->all();
	$differentiationExists = 0;
	$differentiations = null;
	$differentiationCheck = $unit->blocks->where('differentiation_id','!=',13)->isNotEmpty();
	if ($differentiationCheck === true ){
		$differentiationExists = 1;
		$differentiations = $unit->blocks->where('differentiation_id','!=',13)->unique('differentiation_id')->values()->pluck('differentiation_id');
	}
	
	return view('frontend.units.show_units', compact('unit','blocks','differentiationExists','differentiations'));
/*     return view('frontend.units.show', compact('unit')); */
	} 
	
	public function unit_diff($id,$diff) {
	$unit = Unit::find($id);
	$blocks = Block::where([
	['differentiation_id', $diff],
	['unit_id',$id],
	])
	->orWhere([
	['differentiation_id', 13],
	['unit_id',$id],
	])->orderBy('order','asc')->get();
	$differentiationExists = 1;
	$differentiations = $unit->blocks->where('differentiation_id','!=',13)->unique('differentiation_id')->values()->pluck('differentiation_id');
	return view('frontend.units.show_units', compact('unit','blocks','differentiationExists','differentiations'));
	}
	
}


