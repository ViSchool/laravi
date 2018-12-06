<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Subject;
use Auth;
use Carbon;

class UnitController extends Controller
{
	public function __construct() 
    {
     	$this->middleware('auth');
     }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('teacher.toolbox_create',compact('subjects'));
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
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'unit_title'=> 'required|max:255',
		'unit_img' => 'image',
        ]);
        $unit = new Unit;
        $unit->subject_id = $request->subject_id;
        $unit->topic_id = $request->topic_id;
        $unit->unit_title = $request->unit_title;
        $unit->unit_description = $request->unit_description;
        $unit->user_id = Auth::user()->id;
        
        	//Save Image
		if ($request->hasFile('unit_img')){
			$image = $request->file('unit_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/units/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$unit->unit_img = $filename;
			//save thumb image
			$location_big = public_path('images/units/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$unit->unit_img_thumb = $filename_thumb;
		}
        $unit->save();
        
        return redirect()->route('unit.edit',[$unit->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $passed_time = Carbon::createFromTime(0,$unit->start_time,0)->toTimeString();
        $subjects = Subject::all();
        return view('teacher.toolbox_edit',compact('subjects','unit','passed_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'unit_title'=> 'required|max:255',
        		'unit_img' => 'image',
        ]);
        $unit = Unit::find($id);
        $unit->subject_id = $request->subject_id;
        $unit->topic_id = $request->topic_id;
        $unit->unit_title = $request->unit_title;
        $unit->unit_description = $request->unit_description;
        $unit->user_id = Auth::user()->id;
        	//Save Image
		if ($request->hasFile('unit_img')){
			$image = $request->file('unit_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/units/'.$filename);
			Image::make($image)->resize(null, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$unit->unit_img = $filename;
			//save thumb image
			$location_big = public_path('images/units/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$unit->unit_img_thumb = $filename_thumb;
		}
        $unit->save();
        
        return redirect()->route('unit.edit',[$unit->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
