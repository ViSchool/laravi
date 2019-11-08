<?php

namespace App\Http\Controllers;

use App\Content;
use App\Unit;
use App\Topic;
use App\Serie;



use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) 
    {
        $contents = Content::search($request->search)->get();
        $contents3 = $contents->slice(0,3)->all();
        $contentsCount = count($contents);
        $units = Unit::search($request->search)->get();
        $units3 = $units->slice(0,3)->all();
        $unitsCount = count($units);
        $topics = Topic::search($request->search)->get();
        $topics3 = $topics->slice(0,3)->all();
        $topicsCount = count($topics);
        $series = Serie::search($request->search)->get();
        $series3 = $series->slice(0,3)->all();
        $seriesCount = count($series);
        $query = $request->search; 
        return view('frontend.search.search_results', compact('contents3','query','units3','topics3','series3','contentsCount','unitsCount','seriesCount','topicsCount'));
    }   
    
    public function searchContents($query) 
    {
        $contents = Content::search($query)->where('status_id',1)->get();
        return view('frontend.search.search_results_contents', compact('contents','query'));
    }   

    public function searchUnits($query) 
    {
        $units = Unit::search($query)->where('status_id',1)->get();
        return view('frontend.search.search_results_units', compact('units','query'));
    }  
    
    public function searchTopics($query) 
    {
        $topics = Topic::search($query)->where('status_id',1)->get();
        return view('frontend.search.search_results_topics', compact('topics','query'));
    }  

}
