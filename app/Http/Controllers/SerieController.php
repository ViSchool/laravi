<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Admin;
use App\Unit;
use Auth;
use Purifier;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        	$series = Serie::paginate(20);
        	return view('backend.index_series', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        	return view('backend.create_series', compact(''));
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
		'serie_title' => 'required'
		]);
		$serie = new Serie;
		$serie->serie_title = $request->serie_title;
		$currentAdmin = Admin::get_current_admin();
		$serie->createdByUser = $currentAdmin->id;
		$serie->serie_description = Purifier::clean($request->serie_desciption);
		$serie->public = $request->public;
		$serie->save();
		return redirect()->route('backend.series.index');
    }

    public function teacher_store(Request $request) 
    {
        $this->validate(request(), [
		'serie_title' => 'required'
        ]);
        
        $serie = new Serie;
        $unit = Unit::findOrFail($request->unit_id);
        $teacher = Auth::user();
        $serie->serie_title = $request->serie_title;
		$serie->user_id = $teacher->id;
		$serie->serie_description = Purifier::clean($request->serie_desciption);
		$serie->status_id = $unit->status_id;
        $serie->save();
        $unit->serie_id = $serie->id;
        $unit->save();
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serie = Serie::find($id);
        return view ('backend.show_series', compact('serie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        	$this->validate(request(), [
		'serie_title' => 'required'
		]);
		$serie = Serie::findorFail($id);
		$serie->serie_title = $request->serie_title;
		$currentAdmin = Admin::get_current_admin();
		$serie->updatedByUser = $currentAdmin->id;
		$serie->serie_description = Purifier::clean($request->serie_description);
		$serie->public = $request->public;
		$serie->save();
		return redirect()->route('backend.series.index');
    }

    public function teacherSerieApprove($id)
    {
        $serie = Serie::findOrFail($id);
        $serie->status_id = 1;
        $serie->save();	
       	//return to overview of topics
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        	$serie = Serie::findOrFail($id);
		$serie->units()->detach();
		$serie->tags()->detach();	
		$serie->delete();
        return redirect('backend/series');
    }
}
