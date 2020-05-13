<?php

namespace App\Http\Controllers;

use App\Job;
use Auth; 
use App\Task;
use App\Subject;
use App\Topic;
use App\Unit;
use App\Student;
use App\Interaction;
use App\Studentgroup;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth:web');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Auth::user();
        $jobs = Job::where('teacher_id', $teacher->id)->orderBy('studentgroup_id', 'desc')->get();
        $jobsByStudentgroup = $jobs->groupBy([
            'studentgroup_id',
            function ($item) {
                return $item['unit_id'];
            },
        ], $preserveKeys = true);
        return view('teacher.teacher_jobs', compact('jobsByStudentgroup'));
    }

    /**
     * Show all tasks and jobs for one student .
     **/

    public function student_auftraege_index_teacher($id)
    {
        $student = Student::findOrFail($id);
        $teacher = Auth::user();
        $jobs = Job::where([
            ['teacher_id', $teacher->id],
            ['student_id', $student->id],
        ])->orderBy('done_date')->get();
        $jobsByUnit = $jobs->groupBy('unit_id')->all();
        return view('teacher.teacher_student_jobs', compact('student','jobsByUnit')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $topics = Topic::all();
        $teacher = Auth::user();
        $students = Student::where('teacher_id',$teacher->id)->where('studentgroup_id',NULL)->get();
        $studentgroups = Studentgroup::where('teacher_id',$teacher->id)->get();
        $get_today = getdate();
        if($get_today['mday'] < 10) {
            $get_today['mday'] = "0" . $get_today['mday'];
        }
        if($get_today['mon'] < 10) {
            $get_today['mon'] = "0" . $get_today['mon'];
        }
        $today = $get_today['mday'] . "." . $get_today['mon'] . "." . $get_today['year'];
        $interactions = Interaction::all();
        return view('teacher.teacher_jobCreate', compact('topics','subjects','students','studentgroups','today','interactions'));
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
        'unit_id' => 'required',
        'student_id' => 'required',
        'done_date' => 'required',
        ]);

        function save_job($studentgroup, $student, $teacher, $done_date, $unit_id) 
        {
            $job = new Job;
            $job->unit_id = $unit_id;
            $job->teacher_id = $teacher->id;
            $job->student_id = $student;
            $job->studentgroup_id = $studentgroup;
            $job->done_date = $done_date;
            $job->jobStatus_id = 1;
            $job->save();
        }

        $unit_id = $request->unit_id;
        $teacher = Auth::user();
        $done_date_de= $request->done_date;
        $done_date_explode = explode('.',$done_date_de);
        $done_date = $done_date_explode[2] . "-" . $done_date_explode[1] . "-" .$done_date_explode[0] . " 22:00:00"; 
        $student_id = $request->student_id;

        if (strpos($request->student_id,'studentgroup') !== false) {
            $studentgroup_parts = explode("_", $student_id);
            $studentgroup = Studentgroup::find($studentgroup_parts[0]);
            $students = $studentgroup->students->all();
            $single_student = NULL;
        } else {
            $student_parts = explode("_",$student_id);
            $single_student = $student_parts [0];
            $studentgroup = NULL;
        }

        if (isset($students)) {
            foreach ($students as $student) {
                save_job($studentgroup->id, $student->id, $teacher, $done_date, $unit_id);
            }
        } else {
            save_job($studentgroup, $single_student, $teacher, $done_date, $unit_id);
        }
        $job=Job::where('teacher_id',$teacher->id)->max('id');
        session()->flash('success', 'Der Auftrag wurde angelegt.');
        return redirect()->route('rueckmeldungen_erstellen',['job' => $job]);

     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    public function assign_job(Request $request) 
    {
        $this->validate(request(), [
        'firstjob_id' => 'required',
        'studentgroup' => 'required',
        ]);

        if ($request->studentgroup == 1) {
            $firstjob = Job::findOrFail($request->firstjob_id);
            $studentgroup = $firstjob->student->studentgroup;
            $jobs = Job::where('studentgroup_id', $studentgroup->id)->where('unit_id',$firstjob->unit_id)->get();
            foreach($jobs as $job) {
                $job->jobStatus_id = 3;
                $job->save(); 
            }
        } else {
            $firstjob = Job::findOrFail($request->firstjob_id);
            $firstjob->jobStatus_id = 3;
            $firstjob->save(); 
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
