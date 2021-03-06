<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\School;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overriding the RegistersUsers functionalities with my own showRegistrationForm()
     */

    public function showRegistrationForm() 
    {
        $schools = School::all();
        return view ('auth.register',compact('schools'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'teacher_name' => 'required|string|max:255',
            'teacher_surname' => 'required|string|max:255',
            'user_name' => 'unique:users|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'data_privacy' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create($request)
    {
    
        $user = User::create([
            'teacher_name' => $request['teacher_name'],
            'teacher_surname' => $request['teacher_surname'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'school_id' => $request['school_id'],
            'teacher_id' => '9999999',
            'user_name' => $request['email'],
            'contract_id' => $request['contract'],

        ]);

        $user->teacher_id = $user->id;
        if (isset($request->newsletter)){
            $user->newsletter = $request->newsletter;
        }
        $user->save();
        if ($user->contract_id == 2 or 3) {
            $user->assignRole('Lehrer (premium)');
        } else {
            $user->assignRole('Lehrer (free)');
        }

        return $user;
    }

}
