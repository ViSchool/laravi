<?php

namespace App\Http\Controllers;

use App\Student;
use App\Studentgroup;
use App\studentName;
use Auth;
use App\User;
use PDF;
use Hash;
use Illuminate\Http\Request;
use Role;
use Redirect;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
     public function index()
    {
        return view('frontend.students');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'student_name' => 'required', 
        'password' => 'required'
        ]);
        
        $student =new Student;
        $student->student_name = $request->student_name;
        $student->password = Hash::make($request->password);
        $student->class_account = $request->class_account;
        $student->teacher_id = $request->user_id;
        $student->save();
        $student->assignRole('Schüler');
        return view('teacher.teacher_studentaccount');
    }

    public function store_classaccount(Request $request)
    {
        $this->validate(request(), [
        'student_name' => 'required', 
        'password' => 'required'
        ]);
        
        $student =new Student;
        $student->student_name = $request->student_name;
        $student->password = Hash::make($request->password);
        $student->class_account = 1;
        $student->teacher_id = $request->user_id;
        $student->save();
        $student->assignRole('Klasse');
        return view('teacher.teacher_classaccount');
    }


    public function store_group($id)
    {
        $studentgroup = Studentgroup::findOrFail($id);
        if($studentgroup->students()->count() > 0) {
            return Redirect::route('schueleraccounts');
        }
        $names = studentName::where('blocked',0)->take($studentgroup->accounts)->inRandomOrder()->get();
        //save one student for each name
        foreach ($names as $name) { 
            $student =new Student;
            $student->student_name = $name->studentName;
            $name->timestamps = false;
            $name->blocked=1;
            $name->save();
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffledString = substr(str_shuffle($permitted_chars), 0, 10);
            $student->password_cl = $shuffledString;
            $student->password = Hash::make($shuffledString);
            $student->class_account = 0;
            $student->studentgroup_id = $studentgroup->id;
            $student->teacher_id = Auth::user()->id;
            $student->save();
            $student->assignRole('Schüler');
        }
        //get all students, just saved
        $students = Student::where('studentgroup_id',$studentgroup->id)->get();
        $teacher = User::where('teacher_id', $studentgroup->teacher_id)->first();
        $pdf = PDF::loadView('PDF.teacher_studentgroup', compact('students', 'studentgroup', 'teacher'));
        foreach ($students as $student) {
            $student->password_cl = NULL;
            $student->save();
        }
        return $pdf->download('schueleraccounts.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student= Student::find($id);
        $student->removeRole('Schüler');
        $student->delete();
        return redirect()->back();
    }
}
