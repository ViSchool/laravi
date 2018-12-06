<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
