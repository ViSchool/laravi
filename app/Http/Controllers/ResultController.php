<?php

namespace App\Http\Controllers;

use App\Result;
use Purifier;
use Carbon;
use App\Task;
use App\Job;
use Illuminate\Http\Request;

class ResultController extends Controller
{
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
        //
    }


    public function store_ready (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required', 
        'ready_message' => 'required',
        ]);
        
        $task= Task::findOrFail($request->task_id);
        $result = new Result;
        $result->task_id = $request->task_id;
        $result->message = Purifier::clean($request->message);
        $result->created_by = "student";
        $result->ready_message = $request->ready_message;
        $result->save();
        $task->taskStatus_id = 6;
        $task->save();
        Job::progress($task->job);
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->unit_id);
        return redirect()->back();

    }

    public function store_message (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required', 
        'message' => 'required',
        'created_by' => 'required',
        ]);
        
        $task= Task::findOrFail($request->task_id);
        $result = new Result;
        $result->task_id = $request->task_id;
        $result->message = Purifier::clean($request->message);
        $result->created_by = $request->created_by;
        $result->save();
        switch ($request->created_by) {
            case 'student':
                $task->taskStatus_id = 4;
            break;
            case 'teacher':
                $task->taskStatus_id = 5;
            break;

            default:
                # code...
                break;
        }
        
        $task->save();
        Job::progress($task->job);

        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit->id);
        return redirect()->back();

    }

    public function store_result (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required', 
        'result_url' => 'required',
        ]);
        
        $task= Task::findOrFail($request->task_id);
        $result = new Result;
        $result->task_id = $request->task_id;
        $result->message = Purifier::clean($request->message);
        $result->created_by = "student";
        $result->result_url = $request->result_url;
        $result->save();
        $task->taskStatus_id = 6;
        $task->save();
        Job::progress($task->job);
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit->id);
        return redirect()->back();

    }

    public function store_feedback (Request $request) 
    {
        $this->validate(request(), [
        'task_id' => 'required',
        'feedback_message' => 'required',
        ]);

        $task= Task::findOrFail($request->task_id);
        $result = new Result;
        $result->task_id = $request->task_id;
        $result->created_by = "teacher";
        $result->feedback_message=1;
        $result->save();
        $task->taskStatus_id = 7;
        $task->save();
        Job::progress($task->job);
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit->id);
        return redirect()->back();

    }

    public function set_results_viewed_by_student($task_id)
    {
        $task = Task::findOrFail($task_id);
        if ($task->results->isNotEmpty()) {
            foreach($task->results->where('created_by', 'teacher') as $result) {
                $result->result_viewed = Carbon::now();
                $result->save();
            }
        }
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit_id);
        return redirect()->back();
    }
    
    public function set_results_viewed_by_teacher($task_id)
    {
        $task = Task::findOrFail($task_id);
        if ($task->results->isNotEmpty()) {
            foreach($task->results->where('created_by', 'student') as $result) {
                $result->result_viewed = Carbon::now();
                $result->save();
            }
        }
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit_id);
        return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        
    }

    public function delete_ready($task_id)
    {
        $task = Task::findOrFail($task_id);
        $result =  Result::where([
           ['task_id', $task_id],
           ['ready_message', 1],
           ])->firstOrFail();
        $result->delete();
        $task->taskStatus_id = 5;
        $task->save();
        Job::progress($task->job);
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit->id);
        return redirect()->back();
    }

    public function delete_result($task_id)
    {
        $task = Task::findOrFail($task_id);
        $result =  Result::where([
           ['task_id', $task_id],
           ['result_url','!=', NULL],
           ])->firstOrFail();
        $result->delete();
        $task->taskStatus_id = 5;
        $task->save();
        Job::progress($task->job);
        session()->flash('task_news_open', $task->id);
        session()->flash('unit_open',$task->job->unit->id);
        return redirect()->back();
    }
}
