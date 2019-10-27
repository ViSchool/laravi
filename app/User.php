<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ViSchoolVerifyEmailNotification;
use App\Notifications\CustomResetPasswordNotification;
use App\Mail\EmailVerification;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_name', 'teacher_surname','user_name','email', 'password','school_id', 'teacher_id','newsletter' ,'data_privacy'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    
    public function post()
	{
		return $this->belongsTo('App\Post');
	}
	
	public function differentiations()
	{
		return $this->hasMany('App\Differentiation');
    }
    
    public function students()
	{
		return $this->hasMany('App\Student','teacher_id');
    }

    public function studentgroup()
	{
		return $this->hasMany('App\Studentgroup','teacher_id');
    }
    

    public function units()
	{
		return $this->hasMany('App\Unit');
    }
    
    public function contents()
	{
		return $this->hasMany('App\Content');
    }
    
    public function topics()
	{
		return $this->hasMany('App\Topic');
	}
}
