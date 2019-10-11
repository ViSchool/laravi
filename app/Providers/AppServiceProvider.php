<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\EmailVerification;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('layouts.nav' , function ($view) 
        {
        		$view->with('subjects' , \App\Subject::nav_sub());
        });
        
        \View::composer('layouts.nav_teacher' , function ($view) 
        {
        		$view->with('subjects' , \App\Subject::nav_sub());
        });
        
        \View::composer('components.toolbox_tools' , function ($view) 
        {
        		$view->with('subjects' , \App\Subject::nav_sub());
        });
        
        view()->composer('*' , function ($view) 
        {
        		$view->with('admin' , \App\Admin::get_current_admin());
        });

        // Override the email notification for verifying email
        VerifyEmail::toMailUsing(function ($notifiable,$url){
            $mail = new MailMessage;
            $mail->subject('Bitte bestätige Deine Emailadresse bei ViSchool!');
            $mail->markdown('emails.verify-email', ['url' => $url]);
            $mail->from('info@vischool.de');
            return $mail;
        });
    
  }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      setlocale(LC_TIME, 'de_DE');  
	}
}
