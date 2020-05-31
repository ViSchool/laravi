<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StudentLoginController extends Controller
{
    
    public function __construct()
	{
		$this->middleware('guest')->except('logout');
		$this->middleware('guest:student' , ['except' =>['studentLogout']]);
		$this->middleware('guest:admin' , ['except' =>['admin.logout']]);
	}

	public function showLoginForm()
    {
		if(!session()->has('url.intended'))
		{
        session(['url.intended' => url()->previous()]);
    	}
		return view('auth.student-login');
    }
    
    public function login(Request $request)
    {
//     	validate form data
		
		$this->validate($request, [
		'student_name' => 'required',
		'password' => 'required|min:5'
		]);
		

// 		attempt to Log User in 
		if (Auth::guard('student')->attempt(['student_name' => $request->student_name,'password' =>$request->password])){
			return redirect()->intended('');
		}
// if successful then redirect to where they came from
		
// if unsucessfull then redirect back to login with form data
		return redirect()->back()->withInput($request->only('student_name'));
    }
    
    public function studentLogout()
    {
		 Auth::guard('student')->logout();
    	return redirect()->route('vischool');
    }
}
