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
    //Vom Lehrer erstellte Unterrichtseinheit speichern
    public function teacher_store(Request $request)
    {
        $this->validate(request(), [
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'unit_title'=> 'required|max:255'
        ]);

        $unit = new Unit;
        $unit->subject_id = $request->subject_id;
        $unit->topic_id = $request->topic_id;
        $unit->unit_title = $request->unit_title;
        $unit->unit_description = $request->unit_description;
        $unit->user_id = $request->user_id;
        $unit->status_id = 5;
        if (isset($request->differentiation_group)) {
            $unit->differentiation_group = $request->differentiation_group;
        }
        $unit->save();
        return redirect()->route('teacher.units');
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
    

    public function teacher_edit($id)
    {
        $teacher = Auth::user();
        $unit = Unit::find($id);
        $subjects = Subject::all();
        $differentiation_groups = $teacher->differentiations->where('differentiation_group','!=','Alle')->pluck('differentiation_group')->unique();
        return view('teacher.teacher_unitsEdit',compact('subjects','unit','teacher','differentiation_groups'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function teacher_update(Request $request, $id)
    {
        $this->validate(request(), [
        'topic_id' => 'required', 
        'subject_id' => 'required',
        'unit_title'=> 'required|max:255',
        
        ]);
        $unit = Unit::find($id);
        $unit->subject_id = $request->subject_id;
        $unit->topic_id = $request->topic_id;
        $unit->unit_title = $request->unit_title;
        $unit->unit_description = $request->unit_description;
        $unit->user_id = $request->user_id;
        if (isset($request->differentiation_group)) {
            $unit->differentiation_group = $request->differentiation_group;
        }
        $unit->save();
        
        return redirect()->route('teacher.units');

    }

    public function teacherUnitPrivate($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->status_id = 3;
        $unit->save();	
       	//return to overview of topics
        return redirect()->route('teacher.units');
    }

    //An ViSChool zur Freigabe schicken - vom Lehrer erstelltes Thema
    public function teacherUnitViSchool($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->status_id = 2;
        $unit->save();	
       	//return to overview of topics
        return redirect()->route('teacher.units');
    }

    //ViSchool Admin gibt Unterrichtseinheit frei
    public function teacherUnitApprove($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->status_id = 1;
        $unit->save();	
       	//return to overview of topics
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->back();
    }
}
