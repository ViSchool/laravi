<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use App\Unit;
use Purifier;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // public function school_page($schule)
    // {
    //     $school = School::where('school_vischoolUrl','=', $schule)->first();
    //     $teachers = User::where('school_id',$school->id)->pluck('id');
    //     $units = Unit::whereIn('user_id',$teachers)->get(); 
    //     return view('frontend.schools.school_page',compact('units','contents','topics','subjects'));
    // }
    
    public function index()
    {
        $schools = School::orderBy('created_at', 'desc')->paginate(10);
        return view('/backend/index_schools', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('backend.create_schools');
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
        'school_name' => 'required',
        'school_vischoolUrl' => 'required',
        'school_type' => 'required',
        'school_street' => 'required',
        'school_zip_code' => 'required',
        'school_city' => 'required',
        'school_email' => 'email',
        ]);
        $school = new School;
        $school->school_name = $request->school_name;
        $school->school_vischoolUrl = $request->school_vischoolUrl;
        $school->school_type = $request->school_type;
        $school->school_street = $request->school_street;
        $school->school_zip_code = $request->school_zip_code;
        $school->school_city = $request->school_city;
        $school->school_email = $request->school_email;
        $school->school_contact = $request->school_contact;
        $school->school_phone = $request->school_phone;
        $school->school_accountStatus = $request->school_accountStatus;
        $school->school_comments = Purifier::clean($request->school_comments);
        
        $school->save();
        return redirect('backend/schools');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school = School::find($id);
        return view ('backend.show_schools', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
        'school_name' => 'required',
        'school_vischoolUrl' => 'required',
        'school_type' => 'required',
        'school_street' => 'required',
        'school_zip_code' => 'required',
        'school_city' => 'required',
        'school_email' => 'email',
        ]);
        $school = School::findOrFail($id);
        $school->school_name = $request->school_name;
        $school->school_vischoolUrl = $request->school_vischoolUrl;
        $school->school_type = $request->school_type;
        $school->school_street = $request->school_street;
        $school->school_zip_code = $request->school_zip_code;
        $school->school_city = $request->school_city;
        $school->school_email = $request->school_email;
        $school->school_contact = $request->school_contact;
        $school->school_phone = $request->school_phone;
        $school->school_accountStatus = $request->school_accountStatus;
        $school->school_comments = Purifier::clean($request->school_comments);
        
        $school->save();
        return redirect('backend/schools');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return redirect('backend/schools');
    }
}
