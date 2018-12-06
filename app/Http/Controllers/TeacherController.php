<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Unit;
use App\Topic;

class TeacherController extends Controller
{
	public function __construct() 
    {
     	$this->middleware('auth' , ['except'=> ['index','coaching','schulcoaching']]);
     }
    
	
    public function index()
    {
    $subjects = Subject::all();
    $unit01 = Unit::orderBy('updated_at', 'desc')->take(1)->first();
    $units = Unit::orderBy('updated_at', 'desc')->skip(1)->take(10)->get();
    return view ('teacher.teacher_welcome', compact('subjects', 'unit01','units'));
    }
    
    public function coaching()
    {
	return view ('teacher.teacher_coaching');
    }
    
    public function schulcoaching()
    {
	return view ('teacher.teacher_school_coaching');
    }

    
    public function allunits()
    {
        $subjects = Subject::has('topics.unit')->get();
    $topics = Topic::all();
    $units = Unit::all();
    return view ('teacher.teacher_allunits', compact('subjects', 'topics','units'));
    }

}
