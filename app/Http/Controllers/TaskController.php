<?php

namespace App\Http\Controllers;

use App\Task;
use App\Job;
use App\Subject;
use App\Topic;
use App\Unit;
use App\Student;
use App\Interaction;
use App\Studentgroup;



use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
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

    }

    public function student_auftraege_index_teacher($id)
    {
        $student = Student::findOrFail($id);
        $teacher = Auth::user();
        $tasks = Task::where([
            ['teacher_id', $teacher->id],
            ['student_id', $student->id],
        ])->orderBy('done_date')->get();
        $tasksByUnit = $tasks->groupBy('unit_id')->all();
        return view('teacher.teacher_student_tasks', compact('student','tasksByUnit')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $job = Job::findOrFail($id);
        $blocks = $job->unit->blocks;
        $interactions = Interaction::all();
        return view('teacher.teacher_tasksCreate', compact('job','blocks','interactions'));
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
        'block_interaction_ids' => 'required',
        'job_id' => 'required',
        'assignment' => 'required',
        ]);

        function save_tasks($job_id, $block_interaction_ids) {
            foreach ($block_interaction_ids as $block_interaction_id) {
            $block = explode("|", $block_interaction_id);
            $task =new Task;
            $task->block_id = $block[0];
            $task->job_id = $job_id;
            $task->interaction_id = $block[1];
            $task->taskStatus_id = 1;
            $task->save();
            }
        };

        $block_interaction_ids = $request->block_interaction_ids;
        $teacher = Auth::user();
        $job_one = Job::findOrFail($request->job_id);
        if($job_one->studentgroup_id != Null) {
            foreach ($job_one->studentgroup->students as $student) {
                $job= Job::where('student_id',$student->id)->where('unit_id',$job_one->unit_id)->where('teacher_id',$teacher->id)->first();
                save_tasks($job->id, $block_interaction_ids);
                switch ($request->assignment) {
                    case 'sofort':
                        $job->jobStatus_id = 3;
                    break;
                    case 'spaeter':
                        $job->jobStatus_id = 2;
                    break;
                }
            $job->save();
            }
        } else {
            save_tasks($job_one->id, $block_interaction_ids);
            switch ($request->assignment) {
                case 'sofort':
                    $job_one->jobStatus_id = 3;
                break;
                case 'spaeter':
                    $job_one->jobStatus_id = 2;
                break;
            }
            $job_one->save();
        }

        return redirect('/lehrer/auftraege');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
