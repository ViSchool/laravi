<?php

namespace App\Http\Controllers;

use App\Student;
use App\Studentgroup;
use App\studentName;
use App\Task;
use App\Job;
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
        $this->middleware('auth:student')->only('student_auftraege_index_students');
    }
    
     public function index()
    {
        return view('frontend.students');
    }


    public function student_auftraege_index_students() 
    {
        $student = Auth::guard('student')->user();
        $jobs = Job::where('student_id',$student->id)->where('jobStatus_id','>',2)->get();
        $jobsByTeacher = $jobs->groupBy('teacher_id');
        return view('student.student_jobs', compact('student','jobsByTeacher'));
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
        'student_name' => 'required|unique:students', 
        'password' => 'required'
        ]);
        
        $student =new Student;
        $student->student_name = $request->student_name;
        $student->password = Hash::make($request->password);
        $student->class_account = $request->class_account;
        $student->teacher_id = $request->user_id;
        $student->save();
        $student->assignRole('Schüler');
        return back();
    }

    public function store_classaccount(Request $request)
    {
        $this->validate(request(), [
        'student_name' => 'required|unique:students', 
        'password' => 'required'
        ]);
        
        $student =new Student;
        $student->student_name = $request->student_name;
        $student->password = Hash::make($request->password);
        $student->class_account = 1;
        $student->teacher_id = $request->user_id;
        $student->save();
        $student->assignRole('Klasse');
        return back();
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


    //TASKS von der Schülerseite 
    public function store_student_check (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required', 
        'result_for_student_check' => 'required',
        ]);

        $task = Task::find($request->task_id);
        $task->student_check = $request->result_for_student_check;
        $task->save();
        Job::progress($task->job);

        return redirect()->back()->with('unit_open',$task->unit_id);

    }
   
    public function handin_tasks (Request $request) 
    {
        $this->validate(request(), [
        'job_id' => 'required', 
        'student_id' => 'required',
        ]);

        $tasks = Task::where('job_id',$request->job_id)->get();
        foreach ($tasks as $task) {
            $task->taskStatus_id = 6;
            $task->save();
        }
        Job::progress($task->job);
        return redirect()->back()->with('unit_open',$task->unit_id);

    }

    public function setback_tasks (Request $request) 
    {
        $this->validate(request(), [
        'job_id' => 'required',
        'student_id' => 'required',
        ]);

        $tasks = Task::where('job_id',$request->job_id)->get();
        foreach ($tasks as $task) {
            $task->taskStatus_id = 5;
            $task->save();
        }
        Job::progress($task->job);
        return redirect()->back()->with('unit_open',$task->unit_id);

    }

    public function set_status_to_gestartet(Request $request) 
    {
        $this->validate(request(), [
        'job_id' => 'required',
        ]);
        
        $job = Job::find($request->job_id);
        $job->jobStatus_id = 4;
        $tasks = Task::where('job_id', $job->id)->get();
        foreach ($tasks as $task) {
            $task->taskStatus_id = 3;
            $task->save();
        }
        $job->save();
        return redirect()->route('unit.show', ['unit' => $job->unit_id]);
    }


}
