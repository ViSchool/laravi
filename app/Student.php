<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;



class Student extends Authenticatable 
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'student';
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

    public function user()
	{
		return $this->belongsTo('App\User');
	}
    
    public static function get_current_student() {
		return Auth::guard('student')->user();
	}
	public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPasswordNotification($token));
    }

}
