<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Topic;
use App\Subject;
use App\Content;
use App\Tool;
use App\Mail\brokenLinks;
use App\Differentiation;

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

    public function getDynamicTools($id) 
     {
        $tools = Tool::where('id',$id)->pluck("embed_code");
        return json_encode($tools);
    }

	public function sendBrokenLinks()
	{
		Mail::to('katharina@vischool.de')->send(new brokenLinks());
    }
    
    public function getChosenContent($id) 
     {
        $content = Content::where('id',$id)->pluck('content_title');
        return json_encode($content);
    }

    public function getDifferentiations($differentiation_group, $teacher_id) 
     {
        $differentiations = Differentiation::
            where('differentiation_group',$differentiation_group)
            ->whereIn('user_id', [$teacher_id, 23])
            ->pluck('id','differentiation_title');
        return json_encode($differentiations);
    }
}

