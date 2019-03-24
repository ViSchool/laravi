<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create() 
    {
    	return view ('sessions.create');
    }
    
    public function store() 
    {
    $this->validate(request(), [
    	'name' => 'required',
    	'email' => 'required|email',
    	'password' => 'required|confirmed'	
    ]);
    
    
    // create and save user
	$user = new User;
    User::create(request(['name','email','password']));
    //  sign them in   
    auth()->login($user);
    
    return Redirect::intended('/');
    
    }
    
    public function change_password($id, $request) 
    {
    $this->validate(request(), [
    	'name' => 'required',
    	'email' => 'required|email',
    	'password' => 'required|confirmed'	
    ]);
    
    
    // create and save user
    $user = User::find($id);
    if($user->password == $request->oldPassword) {
         $user->password = $request->password;
    }
    else {

    }
    $user->save();
    return Redirect::intended('/');
    }
    
    public function change_settings($id, $request) 
    {
    $this->validate(request(), [
    	'name' => 'required',
    ]);
    
    
    // create and save user
    $user = User::find(§id);
    $user->differentiation_on = $request->diffenrentiation_on;
    $user->newsletter = $request->newsletter;
    $user->save();
    return Redirect::intended('/');
    
	}
}