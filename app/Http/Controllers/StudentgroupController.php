<?php

namespace App\Http\Controllers;

use App\Studentgroup;
use App\studentName;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class StudentgroupController extends Controller
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
        $this->validate(request(), [
        'group_of_students' => 'required|unique:studentgroups,studentgroup_name', 
        'number' => 'required|numeric|between:2,50'
        ]);
        
        $studentgroup =new Studentgroup;
        $studentgroup->studentgroup_name = $request->group_of_students;
        $studentgroup->accounts = $request->number;
        $studentgroup->teacher_id = $request->user_id;
        $studentgroup->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studentgroup  $studentgroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentgroup = Studentgroup::find($id);
        $students = Student::where('studentgroup_id',$id)->get();
        $teacher = User::where('teacher_id', $studentgroup->teacher_id)->first();
        return view('PDF.teacher_studentgroup', compact('studentgroup','students','teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentgroup  $studentgroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentgroup $studentgroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentgroup  $studentgroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentgroup $studentgroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentgroup  $studentgroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentgroup = Studentgroup::findOrFail($id);
        if($studentgroup) {
            $students = Student::where('studentgroup_id',$id)->get();
            $studentnames = studentName::whereIn('studentName',$students)->get();
            foreach ($studentnames as $studentname) {
                $studentname->blocked = 0;
                $studentname->timestamps = false;
                $studentname->save();
            }
            $studentgroup->delete();
        }
        return redirect()->back();
    }
}
