<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

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
    
    public function change_password($id, Request $request) 
    {
        $this->validate(request(), [
    	'oldpassword' => 'required',
    	'password' => 'required|confirmed'	
    ]);
    $user = User::find($id);
    if (Hash::check($request->oldpassword, $user->password)) 
    {
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message','Wir haben Dein neues Passwort gespeichert.'); 
    }
    else {
        return redirect()->back()->with('message','Das Passwort konnte nicht geändert werden. Dein altes Passwort stimmt nicht.');
    };
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