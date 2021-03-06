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
use App\Studentgroup;
use App\Serie;
use App\Admin;
use Auth;
use App\Faq;
use App\Jobs\DeleteTeachersContent;
use App\Notifications\LehrerGeloescht;
use Illuminate\Notifications\Notification;


class TeacherController extends Controller
{
	public function __construct() 
    {
         $this->middleware('auth' , ['except'=> ['index','coaching','schulcoaching','indexBackend','showBackend','verified']]);
         $this->middleware('verified' , ['except'=> ['index','coaching','schulcoaching','indexBackend','showBackend','verified']]);
     }
    
	
    public function index()
    {
    $subjects = Subject::all();
    $unit01 = Unit::orderBy('updated_at', 'desc')->take(1)->first();
    $units = Unit::where('status_id',1)->orderBy('updated_at', 'desc')->skip(1)->take(10)->get();
    $unitsSet01 = Unit::where('status_id',1)->orderBy('updated_at', 'desc')->take(3)->get();
    $unitsSet02 = Unit::where('status_id',1)->orderBy('updated_at', 'desc')->skip(3)->take(3)->get();
    $unitsSet03 = Unit::where('status_id',1)->orderBy('updated_at', 'desc')->skip(6)->take(3)->get();
    return view ('teacher.teacher_welcome', compact('subjects', 'unit01','units', 'unitsSet01','unitsSet02','unitsSet03'));
    }

    public function verified()
    {
        return view ('teacher.teacher_verified');
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
        $studentsCount = Student::role('Schüler')->where('teacher_id',$teacher->id)->count();
        $classCount = Student::role('Klasse')->where('teacher_id',$teacher->id)->count();
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
        $tools = Tool::orderBy('tool_title')->get();
        return view ('teacher.teacher_contents', compact('tools','teacher','contentsBySubject','topics','subjects'));
    }

    public function topics() 
    {
        $teacher = Auth::user();
        $subjects = Subject::all();
        $topics = Topic::where('user_id',$teacher->id)->get();
        return view ('teacher.teacher_topics', compact('teacher','topics','subjects'));
    }

    public function units() 
    {
        $teacher = Auth::user();
        $subjects = Subject::all();
        $units = Unit::where('user_id',$teacher->id)->get();
        $series = Serie::where([
            ['user_id', $teacher->id],
            ['status_id','>',1],
            ])->get();
        $unitsBySubject = $units->groupBy('subject_id')->all();
        return view ('teacher.teacher_units', compact('teacher','units','series','unitsBySubject','subjects'));
    }

    public function students() 
    {
        $teacher = Auth::user();
        $students = Student::role('Schüler')->where([
            ['teacher_id',$teacher->id],
            ['studentgroup_id', NULL],           
            ])->get();
        $studentgroups = Studentgroup::where('teacher_id',$teacher->id)->get();
        return view ('teacher.teacher_studentaccount', compact('teacher','students','studentgroups'));
    }

    public function classes() 
    {
        $teacher = Auth::user();
        $classes = Student::role('Klasse')->where('teacher_id',$teacher->id)->get();
        $privateunits = Unit::where([
            ['user_id',$teacher->id],
            ['status_id',3]
        ])->get();
        return view ('teacher.teacher_classaccount', compact('teacher','classes','privateunits'));
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
        if($unit->differentiation_group == 'Standard') {
            $differentiations = Differentiation::where('differentiation_group', 'Standard')->get();
        } else {
            $differentiations = Differentiation::where('user_id',$teacher->id)->where('differentiation_group', $unit->differentiation_group)->get();
        }
        $contents = Content::where('topic_id', $unit->topic_id)->get();
        $tools = Tool::orderBy('tool_title','asc')->get();
        $subjects = Subject::where('unit_id',$unit->id);
        return view ('teacher.teacher_blocksCreate', compact('teacher','unit','differentiations','contents','blocks','tools','subjects'));
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

    public function accountDowngradeKostenlos() {
        $teacher = Auth::user();
        $teacher->contract_id = 1;
        $teacher->save();
        $teacher->assignRole('Lehrer (free)');
        return back()->with('successDowngrade','Dein Account wurde auf "Kostenlos" umgestellt.');
    }

    public function softDeleteTeacher()
    {
        $teacher = Auth::user();
        Auth::logout();
        $admin= Admin::first();
        //nach 7 Tagen alle privaten Inhalte/Lerneinheiten und User löschen 
        //!! Delay fehlt noch !!
        DeleteTeachersContent::dispatch($teacher)->delay(now()->addDays(7));

        //ViSchool SlackNachricht schicken, dass Benutzer gelöscht wurde (Übergabe des Nutzers und Seite im Admin Bereich mit allen privaten Inhalten/Lerneinheiten)
        $admin->notify(new LehrerGeloescht($teacher));

        $deleted = $teacher->delete();
        if ($deleted) {
            // User was deleted successfully, redirect to login
            return redirect(url('/'));
        } else {
            // User was NOT deleted successfully, so log them back into your application! Could also use: Auth::loginUsingId($user->id);
            Auth::login($teacher);

            // Redirect them back with some data letting them know it failed (or handle however you need depending on your setup)
            return back()->with('status', 'Dein Account konnte nicht gelöscht werden.');
        }

    }

}
