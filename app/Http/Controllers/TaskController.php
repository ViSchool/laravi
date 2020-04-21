<?php

namespace App\Http\Controllers;

use App\Task;
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
    $this->middleware('auth' , ['except'=> ['student_auftraege_index_students','store_student_check','set_status_to_bearbeitung']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Auth::user();
        $tasks = Task::where('teacher_id', $teacher->id)->orderBy('studentgroup_id', 'desc')->get();
        $tasksByStudentgroup = $tasks->groupBy([
            'studentgroup_id',
            function ($item) {
                return $item['unit_id'];
            },
        ], $preserveKeys = true);
        return view('teacher.teacher_tasks', compact('tasksByStudentgroup'));

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

    public function student_auftraege_index_students() 
    {
        $student = Auth::guard('student')->user();
        $tasks = Task::where('student_id',$student->id)->get();
        $tasksByTeacher = $tasks->groupBy([
            'teacher_id',
            function ($item) {
                return $item['unit_id'];
            },
        ], $preserveKeys = true);
        return view('student.student_tasks', compact('student','tasksByTeacher'));
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
        $students = Student::where('teacher_id',$teacher->id)->get();
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
        return view('teacher.teacher_tasksCreate', compact('topics','subjects','students','studentgroups','today','interactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if(isset($request->interaction_btn)) {
        return redirect()->back()->with('unit', $request->unit_id);
        }
        
        $this->validate(request(), [
        'unit_id' => 'required', 
        'student_id' => 'required',
        'done_date' => 'required',
        'block_interaction_ids' => 'required',
        
        ]);
        function save_task_for_blocks ($block_interaction_ids, $block_copies, $studentgroup, $student, $teacher, $done_date, $unit) {
             foreach ($block_interaction_ids as $block_interaction_id) {
                $block = explode("|", $block_interaction_id);
                $task =new Task;
                $task->block_id = $block[0];
                $task->unit_id = $unit->id;
                $task->interaction_id = $block[1];
                $task->taskStatus_id = 1;
                $task->student_id = $student;
                $task->teacher_id = $teacher->id;
                $task->done_date = $done_date;
                $task->archived = 0;
                $task->studentgroup_id = $studentgroup;
                $task->save();
                if (isset($block_copies)) {
                    foreach ($block_copies as $block_copy) {
                        $blockCopy = explode("|",$block_copy);
                        if($blockCopy[1] == $block[2]) {
                            $task =new Task;
                            $task->block_id = $blockCopy[0];
                            $task->unit_id = $unit->id;
                            $task->interaction_id = $block[1];
                            $task->taskStatus_id = 1;
                            $task->student_id = $student;
                            $task->teacher_id = $teacher->id;
                            $task->done_date = $done_date;
                            $task->archived = 0;
                            $task->studentgroup_id = $studentgroup;
                            $task->save();    
                        }
                    }
                }
            };
        };

        $unit = Unit::findorFail($request->unit_id);
        $teacher = Auth::user();
        $done_date_de= $request->done_date;
        $done_date_explode = explode('.',$done_date_de);
        $done_date = $done_date_explode[2] . "-" . $done_date_explode[1] . "-" .$done_date_explode[0]; 
        $student_id = $request->student_id;
        $block_interaction_ids = $request->block_interaction_ids;
        $block_copies = $request->block_interaction_copies;
        

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
                save_task_for_blocks($block_interaction_ids, $block_copies, $studentgroup->id, $student->id, $teacher, $done_date, $unit);
            }
        } else {
            save_task_for_blocks($block_interaction_ids, $block_copies, $studentgroup, $single_student, $teacher, $done_date, $unit);

        }
        return redirect()->route('auftraege');

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

    public function store_student_check (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required', 
        'result_for_student_check' => 'required',
        ]);

        $task = Task::find($request->task_id);
        $task->student_check = $request->result_for_student_check;
        $task->save();

        return redirect()->back()->with('unit_open',$task->unit_id);

    }

    public function set_status_to_gestartet(Request $request) 
    {
        $this->validate(request(), [
        'tasks' => 'required',
        'unit_id' => 'required',
        'student_id' => 'required'
        ]);
        

        foreach($request->tasks as $task_id) {
            $task = Task::where('id',$task_id)->where('student_id',$request->student_id)->get();
            $task->taskStatus_id = 3;
            $task->save();
        } 
        return redirect()->route('unit.show', ['unit' => $request->unit_id]);
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
