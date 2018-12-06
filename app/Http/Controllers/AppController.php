<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Topic;
use App\Subject;
use App\Content;
use App\Mail\brokenLinks;

class AppController extends Controller
{
    public function index()
    {
        $subjects = DB::table('subjects')->pluck("subject_title","id");
        return view('home',compact('subjects'));
    }

     public function getDynamicTopics($id) 
     {
        $topics = Subject::find($id)->topics->pluck("topic_title","id");

        return json_encode($topics);
    }
    
    public function getDynamicContents($id) 
     {
        $contents = Content::where('topic_id',$id)->pluck("content_title","id");

        return json_encode($contents);
    }

	public function sendBrokenLinks()
	{
		Mail::to('katharina@vischool.de')->send(new brokenLinks());
	}
}
