<?php

namespace App\Http\Controllers\Auth;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/lehrer/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest' , ['except'=>['logout','userLogout']]);
        $this->middleware('guest:admin' , ['except' =>['admin.logout']]);
        $this->middleware('guest:student' , ['except' =>['studentLogout']]);

    }

    
    public function userLogout()
    {
    	Auth::guard('web')->logout();
    	return redirect(route('vischool'));
    }
    
    public function showLoginForm()
    {
    if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    return view('auth.login');
    }
}
