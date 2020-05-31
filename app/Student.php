<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;



class Student extends Authenticatable 
{
    use Notifiable;
    use HasRoles;

    protected $guard = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_name', 'student_password','group_of_students','teacher_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function teacher()
	{
		return $this->belongsTo('App\User');
    }

    // public function conUser()
	// {
	// 	return $this->belongsTo('App\ConUser','conUser_id','id');
    // }
    
    public function studentgroup()
	{
		return $this->belongsTo('App\Studentgroup');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function jobs()
    {
        return $this->hasMany('App\Job');
    }

    
    public static function get_current_student() {
		return Auth::guard('student')->user();
	}
	public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPasswordNotification($token));
    }

}
