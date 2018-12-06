<?php

namespace App\Http\Controllers;

use App\question;
use App\Content;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
	$questions = Question::where('content_id',$id)->get();
	$content = Content::find($id);
    return view ('backend.index_questions', compact('questions','content'));
//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        	$content = Content::find($id);
        	return view ('backend.create_questions', compact('content'));
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
		'question' => 'required',
		'answer1' => 'required',
		'solution1' => 'required',
		'answer2' => 'required',
		'solution2' => 'required',
		'content_id' => 'required'
        ]);
		$question = new Question;
		$question->question = $request->question;
		$question->content_id = $request->content_id;
		$question->answer1 = $request->answer1;
		$question->solution1 = $request->solution1;
		$question->answer2 = $request->answer2;
		$question->solution2 = $request->solution2;
		$question->answer3 = $request->answer3;
		$question->solution3 = $request->solution3;
		$question->answer4 = $request->answer4;
		$question->solution4 = $request->solution4;
		$question->answer5 = $request->answer5;
		$question->solution5 = $request->solution5;
		$question->save();
		return redirect()->route('backend.questions.index', [$question->content_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        	$question = Question::find($id);
        	return view ('backend.show_questions', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        	$this->validate(request(), [
		'question' => 'required',
		'answer1' => 'required',
		'solution1' => 'required',
		'answer2' => 'required',
		'solution2' => 'required',
		'content_id' => 'required'
        ]);
		$question = Question::find($id);
		$question->question = $request->question;
		$question->content_id = $request->content_id;
		$question->answer1 = $request->answer1;
		$question->solution1 = $request->solution1;
		$question->answer2 = $request->answer2;
		$question->solution2 = $request->solution2;
		$question->answer3 = $request->answer3;
		$question->solution3 = $request->solution3;
		$question->answer4 = $request->answer4;
		$question->solution4 = $request->solution4;
		$question->answer5 = $request->answer5;
		$question->solution5 = $request->solution5;
		$question->save();
		return redirect()->route('backend.questions.index', [$question->content_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        	$question = Question::findOrFail($id);
        	$content_id = $question->content_id;
		$question->delete();
        return redirect()->route('backend.questions.index', [$content_id]);
    }
}
