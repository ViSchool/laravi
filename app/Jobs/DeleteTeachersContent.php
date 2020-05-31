<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Content;
use App\Unit;
use App\Admin;
use App\User;
use App\Notifications\LehrerInhalteGeloescht;

class deleteTeachersContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $teacher;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Private Inhalte Löschen, nicht private Inhalte auf LehrerID admin setzen
        $privateContents = Content::where('user_id',$this->teacher->id)->where('status_id','>',2)->get();
        foreach($privateContents as $privateContent) {
            $privateContent->delete();
        }
        $publicContents = Content::where('user_id',$this->teacher->id)->where('status_id','<',3)->get();
        foreach($publicContents as $publicContent) {
            $publicContent->user_id = 1;
            $publicContent->save();
        }

        // Private Lerneinheiten Löschen, nicht private Inhalte auf LehrerID admin setzen
        $privateUnits = Unit::where('user_id',$this->teacher->id)->where('status_id','>',2)->get();
        foreach ($privateUnits as $privateUnit) {
            $privateUnit->delete();
        }
        $publicUnits = Unit::where('user_id',$this->teacher->id)->where('status_id','<',3)->get();
        foreach($publicUnits as $publicUnit) {
            $publicUnit->user_id = 1;
            $publicUnit->save();
        }
        $admin = Admin::first();
        $teacher = User::withTrashed()->findOrFail($this->teacher->id);
        $admin->notify(new LehrerInhalteGeloescht($this->teacher));
     }

}
