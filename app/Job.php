<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'done_date',
    ];
    
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function studentgroup()
    {
        return $this->belongsTo('App\Studentgroup');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    public function jobStatus()
    {
        return $this->belongsTo('App\JobStatus' , 'jobStatus_id');
    }

    public static function progress(Job $job) {
        $tasks = $job->tasks;

        //Status des Auftrags neu bestimmen

        if (count($tasks) == count($tasks->where('taskStatus_id',2))) {
        $job->jobStatus_id = 3; //Zugeteilt

        }   elseif (count($tasks) == count($tasks->where('taskStatus_id',3))) {
                $job->jobStatus_id = 4; //Gestartet

        }  elseif (count($tasks) == count($tasks->where('taskStatus_id',6))) {
           $job->jobStatus_id = 11; //Abgegeben

        }   elseif (count($tasks) == count($tasks->where('taskStatus_id',7))) {
                $job->jobStatus_id = 12; //Fertig
        }   else {

                if (count($tasks->where('taskStatus_id',4)) > 0) {
                    if (count($tasks->where('taskStatus_id', 6)) > 0 && count($tasks->where('taskStatus_id', 6)) < count($tasks)) {
                        $job->jobStatus_id = 7; //Schülernachricht und Ergebnis(se) liegen vor
                    } else {
                    $job->jobStatus_id = 5; //Schülernachricht liegt vor
                    }
                }  elseif (count($tasks->where('taskStatus_id', 6)) > 0 && count($tasks->where('taskStatus_id', 6)) < count($tasks)){
                        $job->jobStatus_id = 9; //Ergebnis(se) liegen vor
                }  elseif (count($tasks->where('taskStatus_id', 7)) > 0 && count($tasks->where('taskStatus_id', 7)) < count($tasks)) {
                        $job->jobStatus_id = 10; //Korrekturen liegen vor

                }  elseif (count($tasks->where('taskStatus_id', 5)) > 0) {
                        if (count($tasks->where('taskStatus_id', 6)) > 0 && count($tasks->where('taskStatus_id', 6)) < count($tasks)) {
                            $job->jobStatus_id = 8; //Lehrernachricht und Korrektur(en) liegen vor
                            } else {
                                $job->jobStatus_id = 6; //Lehrernachricht liegt vor
                        }
                    }
            }
            
        $job->save();

        return; 
    } 

}
