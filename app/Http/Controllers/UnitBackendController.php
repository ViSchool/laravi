<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Topic;
use App\Subject;
use App\Tag;
use App\Device;
use App\Tool;
use App\Portal;
use App\Type;
use App\Video;
use Auth;
use App\Admin;
use Youtube;
use App\Content;
use App\Block;
use App\Serie;
use App\User;
use App\Status;
use Purifier;
use Image;

class UnitBackendController extends Controller
{
    public function __construct() 
    {
     	$this->middleware('auth:admin');
     }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::orderBy('created_at', 'desc')->paginate(10);
        $subjects = Subject::orderBy('subject_title','asc')->get();
        $admin = Auth::guard('admin')->user();
        return view('/backend/index_units', compact('units','subjects','admin'));
    }
    
    public function index_subject($id)
    {
    	$units = Unit::where('subject_id',$id)->orderBy('unit_title', 'desc')->paginate(10);
        $currentSubject = Subject::find($id);
        $topics = $currentSubject->topics()->orderBy('topic_title','asc')->get();
        $admin = Auth::guard('admin')->user();
        return view('/backend/index_units_subjectfilter', compact('units','topics','currentSubject','admin'));
    }

	public function index_topic($subject,$topic)
    {
    	$units = Unit::where('topic_id',$topic)->orderBy('unit_title', 'desc')->paginate(10);
        $currentTopic = Topic::find($topic);
        $currentSubject = Subject::find($subject);
        $topics = $currentSubject->topics()->orderBy('topic_title','asc')->get();
        $admin = Auth::guard('admin')->user();
        return  view('/backend/index_units_topicfilter', compact('units','currentTopic','currentSubject','topics','admin'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$subjects = Subject::orderBy('subject_title', 'asc')->get();
        $topics = Topic::orderBy('topic_title', 'asc')->get();
        $series = Serie::orderBy('serie_title','asc')->get();
        $admin = Auth::guard('admin')->user();
        $teacher = User::where('email',$admin->email)->first();
        $differentiation_groups = $teacher->differentiations->where('differentiation_group','!=','Alle')->pluck('differentiation_group')->unique();
        return view('backend.create_units', compact('subjects','topics','admin','series','teacher','differentiation_groups') );

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
            //get teacher which has the same email address as the admin
        $admin = Auth::guard('admin')->user();
        $teacheruser = User::where('user_name',$admin->email)->first();
        $unit->user_id = $teacheruser->id;

        $unit->serie_id = $request->serie;
        $unit->differentiation_group = $request->differentiation_group;
        	//Save Image
		if ($request->hasFile('unit_img')){
			$image = $request->file('unit_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/units/'.$filename);
			Image::make($image)->resize(355, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$unit->unit_img = $filename;
			//save thumb image
			$location_big = public_path('images/units/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$unit->unit_img_thumb = $filename_thumb;
		}
        	
        $unit->save();
        return redirect()->route('backend.units.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::find($id);
        $subjects = Subject::where('id','!=',$unit->subject_id)->orderBy('subject_title','asc')->get();
        $currentSubject = $unit->subject;
        $currentSerie = $unit->serie;
        $series = Serie::all();
        $admin = Auth::guard('admin')->user();
        $teacher = User::where('email',$admin->email)->first();
        $differentiation_groups = $teacher->differentiations->where('differentiation_group','!=','Alle')->pluck('differentiation_group')->unique();
        $statuses = Status::all();
        return view ('backend.show_units', compact('series','unit','subjects','currentSubject','currentSerie','admin','differentiation_groups','statuses'));
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
        
        $unit->serie_id = $request->serie;
        $unit->differentiation_group = $request->differentiation_group;
        	//Save Image
		if ($request->hasFile('unit_img')){
			$image = $request->file('unit_img');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$filename_thumb = 'thumb'. $filename;
			//save big image
			$location = public_path('images/units/'.$filename);
			Image::make($image)->resize(355, 200, function ($constraint) {
				$constraint->aspectRatio();})->save($location);
			$unit->unit_img = $filename;
			//save thumb image
			$location_big = public_path('images/units/'.$filename_thumb);
			Image::make($image)->resize(null, 50, function ($constraint) {
				$constraint->aspectRatio();})->save($location_big);
			$unit->unit_img_thumb = $filename_thumb;
        }
        $unit->status_id = $request->status_id;      
        $unit->save();
        
        return redirect()->route('backend.units.show',[$unit->id]);
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('backend.units.index');
    }
}
