<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Subject;
use App\Tag;
use Auth;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Image;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$topics = Topic::orderBy('created_at', 'desc')->paginate(10);
        return view('/backend/index_topics', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
	{
        $subjects = Subject::orderBy('subject_title', 'asc')->get();
        $tags = Tag::orderBy('tag_name','asc')->get();
        $admin = Auth::guard('admin')->user();
        return view('backend.create_topics', compact('subjects','tags'));

	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate(request(), [
        'topic_title' => 'required',
        'subjects' => 'required',
        ]);

        $topic =new Topic;
        $topic->topic_title = $request->topic_title;
        $user = Admin::find($request->admin_id);
        $teacher = User::where('email',$user->email)->first();
        $topic->user_id = $teacher->id;
        $topic->status_id = 2;
        
		//Save alle data from create_topics form
        $topic->save();	
        //sync topic with all subjects
        $topic->subjects()->sync($request->subjects, false);
        
        //save new tags and sync
        if ($request->filled('tags')){
         	$tags = Tag::syncTags($request);
         	$topic->tags()->sync($tags, false);
         } elseif (
        	$topic->tags()->sync($request->tags, false)
        );

        //return to overview of topics
        return redirect('backend/topics');
    }

     public function teacher_store(Request $request)
    {
		$this->validate(request(), [
        'topic_title' => 'required|max:255|unique:topics,topic_title',
        'user_id' => 'required|numeric',
        'subjects' => 'required',
        ]);

        $topic =new Topic;
        $topic->topic_title = $request->topic_title;
        $topic->status_id = 2;
        $topic->user_id = $request->user_id;
		//Save alle data from create_topics form
        $topic->save();
		$topic->subjects()->sync($request->subjects, false);
       	//return to overview of topics
        return redirect('lehrer/themen');
    }
    
    //Privat veröffentlichen -  vom Lehrer erstelltes Thema 
    public function teacherTopicPrivate($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->status_id = 3;
        $topic->save();	
       	//return to overview of topics
        return redirect('lehrer/themen');
    }

    //An ViSChool zur Freigabe schicken - vom Lehrer erstelltes Thema
    public function teacherTopicViSchool($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->status_id = 2;
        $topic->save();	
       	//return to overview of topics
        return redirect('lehrer/themen');
    }

    //ViSchool Admin gibt Thema frei
    public function teacherTopicApprove($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->status_id = 1;
        $topic->save();	
       	//return to overview of topics
        return redirect()->back();
    }

    /**Function to show single entries:
    
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $topic = Topic::find($id);
        $currentSubjects = $topic->subjects->pluck('subject_title')->all();
        $subjects = Subject::orderBy('subject_title', 'asc')->get();
        return view ('backend.show_topics', compact('topic','subjects','currentSubjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'topic_title' => 'required',
        'subjects' => 'required',
        ]);
        
        $topic = Topic::findOrFail($id);
        $topic->topic_title = $request->topic_title;
        
		//Save alle data from create_topics form
        $topic->save();
        $topic->subjects()->sync($request->subjects);
        //Noch einzufügen: Nachricht an Lehrer, wenn dieses Thema einem Lehrer gehört
		
       //return to overview of topics
        return redirect('backend/topics');
    }
    
    public function teacher_update(Request $request, $id)
    {
        $this->validate(request(), [
        'topic_title' => 'required',
        'subjects' => 'required',
        ]);
        
        $topic = Topic::findOrFail($id);
        $topic->topic_title = $request->topic_title;
        
		//Save alle data from create_topics form
        $topic->save();
        $topic->subjects()->sync($request->subjects);
		
        //return to overview of topics
        return redirect('lehrer/themen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        if($topic->unit->count() > 0) {
            Session::flash('message', "Das Thema konnte nicht gelöscht werden, weil noch Lerneinheiten zu diesem Thema vorhanden sind.");
            return redirect()->back();
        } else {
        $topic->subjects()->detach();
        $topic->tags()->detach();
        $topic->delete();
        return redirect()->back();
        }
    }
}
