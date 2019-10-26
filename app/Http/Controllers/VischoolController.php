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
use App\Differentiation;
use App\Serie;
use App\Tag;
use Auth;
use Jenssegers\Agent\Agent;


class VischoolController extends BaseController

 

{
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
	
	$subjects = Subject::nav_sub();
	$posts = Post::get_five_posts();
	$agent = new Agent();
	$browser = $agent->browser();
	return view('vischool', compact('subjects','posts','browser'));
	}
	
	public function subjects_index() {
	
	$subjects = Subject::all();
	return view('frontend.subjects.index', compact('subjects'));
	}
	
	public function subject_show ($id) {
		$teacher = Auth::user();
		$subject = Subject::find($id);
		$publicTopics = $subject->topics->where('status_id',1);
		if (isset ($teacher)){
			$privateTopics = $subject->topics->whereIn('status_id',[2,3])->where('user_id',$teacher->teacher_id);	
		}
		else{
			$privateTopics = [];
		}
		$klassenstufeTags = Tag::where('tag_group','Klassenstufe')->get();
		return view('frontend.subjects.subject_topics', compact('subject', 'publicTopics','privateTopics','klassenstufeTags'));
	} 
	


	public function topics_index() {
	return view('frontend.topics.index', compact('topics'));
	}
	
	public function topic_show($id) {
	
		$teacher = Auth::user();
		$student = Auth::guard('student')->user();
		$topic = Topic::find($id);
		$breadcrumbs = Breadcrumbs::addCrumb('Startseite', '/');
		$breadcrumbs = Breadcrumbs::addCrumb($topic->subjects()->first()->subject_title , '/subjects/'. $topic->subjects()->first()->id);
		$breadcrumbs = Breadcrumbs::addCrumb($topic->topic_title,'/topic/'. $topic->id);

		$publicContents = $topic->content->where('status_id',1)->sortByDesc('updated_at');
		$publicUnits = $topic->unit->where('status_id',1)->where('serie_id',NULL)->sortByDesc('updated_at');
		$series = $topic->unit->where('serie_id','>',0)->pluck('serie_id')->unique();
		$publicSeries = Serie::whereIn('id', $series)->where('status_id', 1)->withCount('units')->get();
		
		if (isset ($teacher)){
			$privateContents = $topic->content->whereIn('status_id',[2,3])->where('user_id',$teacher->teacher_id)->sortByDesc('updated_at');
			$privateUnits = $topic->unit->whereIn('status_id',[2,3])->where('user_id',$teacher->teacher_id)->where('serie_id',NULL)->sortByDesc('updated_at');
			$privateSeries = Serie::whereIn('id',$series)->whereIn('status_id',[2,3])->where('user_id',$teacher->teacher_id)->withCount('units')->get();
		}
		elseif (isset ($student)){
			
			$privateContents = $topic->content->whereIn('status_id',[2,3])->where('user_id',$student->teacher_id)->sortByDesc('updated_at');
			$privateUnits = $topic->unit->whereIn('status_id',[2,3])->where('user_id',$student->teacher_id)->where('serie_id',NULL)->sortByDesc('updated_at');
			$privateSeries = Serie::whereIn('id',$series)->whereIn('status_id',[2,3])->where('user_id',$student->teacher_id)->get();	
		}
		else {
			$privateContents =[];
			$privateUnits = [];
			$privateSeries = [];

		}
		return view('frontend.topics.topic_contents', compact('breadcrumbs','publicContents','privateContents','topic','publicUnits','privateUnits','privateSeries','publicSeries'));
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

	$relatedContents = Content::where([
		['topic_id',$content->topic_id],
		['id','!=',$content->id]
		])->inRandomOrder()->take(3)->get();

	return view('frontend.contents.show_contents', compact('breadcrumbs','content','aspect_ratio', 'reviews','average_score','question','finalResult','correctAnswers','relatedContents'));
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

	public function units_serie($id) {
	$serie = Serie::find($id);
	$units = Unit::where('serie_id','=',$id)->get();
	$topic = $units->first()->topic_id;
	//get reviews
	$reviews = Review::where('content_id',$topic)->get();
	$average_score = $reviews->avg('overall_score');
	return view('frontend.units.units_serie', compact('serie','units','average_score'));
	/*$units = Unit::all();
	return view('frontend.units.index', compact('units')); */
	}
	
	public function unit_show($id) {
	$unit = Unit::find($id);
	if ($unit->differentiation_group != NULL) {
		$differentiations = Differentiation::where('differentiation_group',$unit->differentiation_group)->skip(1)->take(10)->get();
		$startDifferentiation = Differentiation::where('differentiation_group',$unit->differentiation_group)->first();
		$blocks = Block::where('unit_id',$unit->id)->whereIn('differentiation_id',[$startDifferentiation->id, 13])->orderBy('order')->get();
		return view('frontend.units.show_units', compact('unit','blocks','differentiations','startDifferentiation'));
	}
	else {
		$blocks = Block::where('unit_id',$unit->id)->orderBy('order')->get();
		return view('frontend.units.show_units', compact('unit','blocks'));
		}
/*     return view('frontend.units.show', compact('unit')); */
	} 
	
	public function unit_diff($id,$diff) {
	$unit = Unit::find($id);
	if ($unit->differentiation_group != NULL) {
		$differentiations = Differentiation::where('differentiation_group',$unit->differentiation_group)->get();
		$startDifferentiation = Differentiation::find($diff);
		$blocks = Block::where('unit_id',$unit->id)->whereIn('differentiation_id',[$startDifferentiation->id, 13])->orderBy('order')->get();
		return view('frontend.units.show_units', compact('unit','blocks','differentiations','startDifferentiation'));
	}
	else {
		$blocks = Block::where('unit_id',$unit->id)->orderBy('order')->get();
		return view('frontend.units.show_units', compact('unit','blocks'));
		}
	
	}
	
}


