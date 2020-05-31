<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use View;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;
    
	protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function post()
	{
		return $this->hasMany('App\Post');
	}

	public static function get_current_admin() {
		return Auth::guard('admin')->user();
	}
	public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function routeNotificationForSlack() {
        return env('SLACK_WEBHOOK_URL');
    }

}
