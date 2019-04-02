<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentLoginController extends Controller
{
    
    public function __construct()
	{
		$this->middleware('guest:student' , ['except' =>['studentLogout']]);
	}
    
    public function login(Request $request)
    {
//     	validate form data
		$this->validate($request, [
		'student_name' => 'required',
		'student_password' => 'required|min:6'
		]);
// 		attempt to Log User in 
		if (Auth::guard('student')->attempt(['student_name' => $request->student_name,'student_password' =>$request->student_password], $request->remember_check)){
			return redirect()->intended(route('vischool'));
		}
// if successful then redirect to where they came from
		
// if unsucessfull then redirect back to login with form data
		return redirect()->back()->withInput($request->only('student_name','remember_check'));
    }
    
    public function adminLogout()
    {
    	Auth::guard('admin')->logout();
    	return redirect(route('vischool'));
    }
}
