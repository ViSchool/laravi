<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Unit;
use App\Topic;
use App\User;
use App\School;
use App\Content;
use App\Tool;
use App\Differentiation;
use App\Block;
use App\Student;
use Auth;

class TeacherController extends Controller
{
	public function __construct() 
    {
         $this->middleware('auth' , ['except'=> ['index','coaching','schulcoaching','indexBackend','showBackend']]);
         $this->middleware('verified' , ['except'=> ['index','coaching','schulcoaching','indexBackend','showBackend']]);
     }
    
	
    public function index()
    {
    $subjects = Subject::all();
    $unit01 = Unit::orderBy('updated_at', 'desc')->take(1)->first();
    $units = Unit::orderBy('updated_at', 'desc')->skip(1)->take(10)->get();
    $unitsSet01 = Unit::orderBy('updated_at', 'desc')->take(3)->get();
    $unitsSet02 = Unit::orderBy('updated_at', 'desc')->skip(3)->take(3)->get();
    $unitsSet03 = Unit::orderBy('updated_at', 'desc')->skip(6)->take(3)->get();
    return view ('teacher.teacher_welcome', compact('subjects', 'unit01','units', 'unitsSet01','unitsSet02','unitsSet03'));
    }

    public function coaching()
    {
	return view ('teacher.teacher_coaching');
    }
    
    public function schulcoaching()
    {
	return view ('teacher.teacher_school_coaching');
    }

    public function thanks()
    {
	return view ('teacher.teacher_thanks');
    }


    public function allunits()
    {
    $subjects = Subject::has('topics.unit')->get();
    $topics = Topic::all();
    $units = Unit::all();
    return view ('teacher.teacher_allunits', compact('subjects', 'topics','units'));
    }

    public function lehrerkonto() 
    {
        $teacher = Auth::user();
        $schools = School::all();
        $studentsCount = User::role('Schüler')->where('teacher_id',$teacher->id)->count();
        $classCount = User::role('Klasse')->where('teacher_id',$teacher->id)->count();
        $differentiations = Differentiation::where('user_id',$teacher->id)->get();
        return view ('teacher.teacher_profile', compact('teacher','schools','studentsCount','classCount'));
    }

    public function contents() 
    {
        $teacher = Auth::user();
        $subjects = Subject::all();
        $contents = Content::where('user_id',$teacher->id)->get();
        $contentsBySubject = $contents->groupBy('subject_id')->all();
        $topics = Topic::all();
        $tools = Tool::all();
        return view ('teacher.teacher_contents', compact('tools','teacher','contentsBySubject','topics','subjects'));
    }

    public function topics() 
    {
        $teacher = Auth::user();
        $subjects = Subject::all();
        $topics = Topic::where('user_id',$teacher->id)->get();
        return view ('teacher.teacher_topics', compact('teacher','contents','topics','subjects'));
    }

    public function units() 
    {
        $teacher = Auth::user();
        $subjects = Subject::all();
        $units = Unit::where('user_id',$teacher->id)->get();
        $unitsBySubject = $units->groupBy('subject_id')->all();
        return view ('teacher.teacher_units', compact('teacher','units','unitsBySubject','subjects'));
    }

    public function students() 
    {
        $teacher = Auth::user();
        $students = Student::where('teacher_id',$teacher->id)->get();
        $classes = Student::where([
            ['teacher_id',$teacher->id],
            ['class_account',1]
        ])->get();
        return view ('teacher.teacher_students', compact('teacher','students','classes'));
    }

    public function create_unit() 
    {
        $teacher = Auth::user();
        $topics = Topic::all();
        $subjects = Subject::all();
        $differentiation_groups = $teacher->differentiations->where('differentiation_group','!=','Alle')->pluck('differentiation_group')->unique();
        return view ('teacher.teacher_unitsCreate', compact('teacher','topics','subjects','differentiation_groups'));
    }

    public function create_block($unit_id) 
    {
        $teacher = Auth::user();
        $unit = Unit::findOrFail($unit_id);
        $blocks = Block::where('unit_id',$unit->id);
        $differentiations = Differentiation::where([
            ['user_id',$teacher->id],
            ['differentiation_group',$unit->differentiation_group]
        ])->get();
        $contents = Content::where('topic_id', $unit->topic_id)->get();
        return view ('teacher.teacher_blocksCreate', compact('teacher','unit','differentiations','contents','blocks','differentiation_groups'));
    }

 //Lehrerkonten im Backend zeigen   
    public function indexBackend()
    {
        $teachers = User::whereRaw('teacher_id = id')->get();
        return view ('backend.index_teacher', compact('teachers'));
    }

    public function showBackend($id)
    {
        $teacher = User::findOrFail($id);
        $students = User::role('Schüler')->where([
            ['id', '!=', $id],
            ['teacher_id',$id],
        ])->get();
         $classes = User::role('Klasse')->where([
            ['id', '!=', $id],
            ['teacher_id',$id],
        ])->get();


        return view ('backend.show_teacher', compact('teacher','students','classes'));
    }



}
