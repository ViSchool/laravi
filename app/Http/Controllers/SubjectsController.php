<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Unit;
use App\Serie; 
use App\Icon;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$subjects = Subject::orderBy('created_at', 'desc')->paginate(10);
        return view('/backend/index_subjects', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::orderBy('icon_title','asc')->get();
        return view('backend.create_subjects',compact('icons'));
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
        'subject_title' => 'required',
        'subject_icon' => 'required'
        ]);
        Subject::create(request(['subject_title','subject_icon']));
        return redirect('backend/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        $icons = Icon::orderBy('icon_title','asc')->get();
        $unitsWithSeries = Unit::where('subject_id',$subject->id)->pluck('serie_id');
        if (count($unitsWithSeries)>0) {
        $series = Serie::wherein('id',$unitsWithSeries)->get();
        } else {
            $series = 0;
        };
        return view ('backend.show_subjects', compact('subject','icons','series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'subject_title' => 'required',
        'subject_icon' => 'required'
        ]);
        $subject = Subject::findOrFail($id);
        $subject->subject_title=request('subject_title');
        $subject->subject_icon=request('subject_icon');
        $subject->save();
        return redirect('backend/subjects');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$subject = Subject::findOrFail($id);
		$subject->topics()->detach();	
		$subject->delete();
        return redirect('backend/subjects');
    }

}		
