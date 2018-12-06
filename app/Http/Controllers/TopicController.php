<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Subject;
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
		$subjects = Subject::orderBy('created_at', 'desc')->get();
        return view('backend.create_topics', compact('subjects'));

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
        
        ]);
        $topic =new Topic;
        $topic->topic_title = $request->topic_title;
        
		//Save alle data from create_topics form
		$topic->save();	
		$topic->subjects()->sync($request->subjects, false);
       	//return to overview of topics
        return redirect('backend/topics');
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
        $subjects = Subject::all();
        return view ('backend.show_topics', compact('topic','subjects'));
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
        ]);
        
        $topic = Topic::findOrFail($id);
        $topic->topic_title = $request->topic_title;
        
		//Save alle data from create_topics form
		$topic->save();	
		$topic->subjects()->sync($request->subjects);
       	//return to overview of topics
        return redirect('backend/topics');
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
        $topic->subjects()->detach();
        $topic->delete();
        return redirect('backend/topics');
    }
}
