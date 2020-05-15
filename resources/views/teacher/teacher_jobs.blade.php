@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Aufträge</h4>
    </div>
</section> 
@endsection

@section ('content')
	<div class="container mt-3">
      <h3>Von Dir erstellte Aufträge</h3>
      <p>"Aufträge" sind öffentliche oder private Lerneinheiten, die Du einzelnen Schülern oder ganzen Klassen zur Erledigung zuweisen kannst. Wenn Du einen Auftrag erstellst, dann bekommt jeder Schüler einen entsprechenden Eintrag auf seiner Auftragsliste und kann Dir danach seine Ergebnisse freigeben.  </p>
      <p>Aufträge, die Du erstellst, können nur die Schüler sehen, denen Du Aufträge erteilt hast. </p>
   </div>
   <div class="container">
      <a class="btn btn-primary form-control" href="/lehrer/auftrag/erstellen">Einen neuen Auftrag erstellen</a>
   </div>

   <div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Aufträge hast Du bereits erstellt:</h3>

    @isset($jobsByStudentgroup)
        @foreach ($jobsByStudentgroup as $studentgroup_id  => $jobsByUnits)
            @if ($studentgroup_id !== "")
                @php
                    $studentgroup = App\Studentgroup::findOrFail($studentgroup_id);
                @endphp


                <h3 class="mt-3 text-brand-blue">Aufträge an Klasse: "{{$studentgroup->studentgroup_name}}"</h3>

                <div class="accordion" id="accordion_{{$studentgroup->id}}">
                    @foreach ($jobsByUnits as $unit_id => $jobs)
                        @php
                            $unit = App\Unit::findOrFail($unit_id);
                            $count_started = count($jobs->where('jobStatus_id','>',3));
                            $count_finished = count($jobs->where('jobStatus_id','>',10));
                            $countNewsPerUnit = 0;
                            //News für die gesamte Einheit zählen

                            foreach ($jobs as $job) {
                                $news = 0;
                                $tasks_student = $job->tasks;
                                foreach ($tasks_student as $task_student) {
                                    $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                    $countNewsPerUnit = $countNewsPerUnit + $news;
                                }
                            }
                        @endphp
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <div class="d-flex flex-row">
                                    <h2 class="mb-0 col-6">
                                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}_{{$studentgroup->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}_{{$studentgroup->id}}">
                                            {{$unit->unit_title}}
                                        </button>
                                    </h2>
                                    <div class="col-2 m-0 p-0">
                                        @if($countNewsPerUnit > 0)
                                            @php
                                                session()->flash('unit_open',$job->unit_id);
                                            @endphp
                                            <button class="btn btn-link m-0 p-0" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}_{{$studentgroup->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}_{{$studentgroup->id}}">
                                                <span class=""><i class="fa-2x far fa-envelope"></i></span>
                                                <small><span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-10px;">{{$countNewsPerUnit}}</span></small>
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                    @if(count($jobs->where('jobStatus_id',2)) > 0)
                                        <form action="/lehrer/auftrag/zuteilen" method="post" enctype="multipart/form-data">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="firstjob_id" value="{{$jobs->first()->id}}">
                                            <input type="hidden" name="studentgroup" value="1">
                                            <button title="Jetzt die Aufträge für die Klasse {{$studentgroup->studentgroup_name}} zuweisen und mit dem Lernen beginnen lassen" class="btn-sm" type="submit"><i class="fas fa-user-check"></i> Aufträge jetzt zuteilen</button>
                                        </form>
                                    @elseif (count($jobs->where('jobStatus_id', '>',3)) > 0)
                                        @if($count_started > $count_finished)
                                            <small class="text-right">{{$count_started}}/{{count($jobs)}} Schülern haben angefangen</small>
                                        @else
                                            <small class="text-right">{{$count_finished}}/{{count($jobs)}} Schülern sind fertig</small>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </div>

                            <div id="collapse_{{$unit->id}}_{{$studentgroup->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_{{$studentgroup->id}}">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th class="text-center">zu erledigen bis</th>
                                                <th class="text-center">Neue Nachrichten</th>
                                                <th class="text-center">Stand der Bearbeitung</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($jobs as $job)
                                                    @php
                                                        //Anzahl neuer Nachrichten für diesen Schüler zählen
                                                        $count_news = 0;
                                                        $tasks_student = $job->tasks;
                                                        foreach ($tasks_student as $task_student) {
                                                            $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                                            $count_news = $count_news + $news;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/{{$job->student_id}}#card_unit{{$job->unit_id}}">{{$job->student->student_name}}</a></td>
                                                        <td class="text-center">{{$job->done_date->formatLocalized('%d. %B %Y')}}</td>
                                                        <td class="text-center">
                                                            @if($count_news > 0)
                                                            @php
                                                                session()->flash('unit_open',$job->unit_id);
                                                            @endphp
                                                                <a href="/lehrer/auftraege/schueler/{{$job->student_id}}#card_unit{{$job->unit_id}}"> 
                                                                    <span class="ml-3"><i class="fa-2x far fa-envelope"></i></span>
                                                                    <small><span class="badge news_notify badge-danger" style="position: relative; top:-20px; left:-12px;">{{$count_news}}</span></small>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($job->jobStatus_id < 3)
                                                                <small>Noch nicht zugeteilt</small>
                                                            @else 
                                                                <small>{{$job->jobStatus->jobStatus_name}}</small>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else {{--wenn keine Klasse festgelegt wurde, nur Einzelschüler--}}

                <h3 class="mt-5 text-brand-blue">Aufträge an einzelne Schüler</h3>
                <div class="accordion" id="accordion_singleStudent">
                    @foreach ($jobsByUnits as $unit_id => $jobs)
                        @php
                            $unit = App\Unit::findOrFail($unit_id);
                            //News für die gesamte Einheit zählen
                            $countNewsPerUnit = 0;
                            foreach ($jobs as $job) {
                                $news = 0;
                                $tasks_student = $job->tasks;
                                foreach ($tasks_student as $task_student) {
                                    $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                    $countNewsPerUnit = $countNewsPerUnit + $news;
                                }
                            }





                        @endphp
                        <div class="card">
                            <div class="card-header" id="headingOne">
                               <div class="d-flex flex-row">
                                    <h2 class="mb-0 col-6">
                                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}">
                                            {{$unit->unit_title}}
                                        </button>
                                    </h2>
                                    <div class="col-2 m-0 p-0">
                                        @if($countNewsPerUnit > 0)
                                            @php
                                                session()->flash('unit_open',$job->unit_id);
                                            @endphp
                                            <button class="btn btn-link m-0 p-0" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}">
                                                <span class=""><i class="fa-2x far fa-envelope"></i></span>
                                                <small><span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-10px;">{{$countNewsPerUnit}}</span></small>
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                    </div>
                                </div>
                            </div>

                            <div id="collapse_{{$unit->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion_singleStudent">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th class="text-center">zu erledigen bis</th>
                                                <th class="text-center">Neue Nachrichten</th>
                                                <th class="text-center">Stand der Bearbeitung</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($jobs as $job)
                                                @php
                                                    //Anzahl neuer Nachrichten für diesen Schüler zählen
                                                    $count_news = 0;
                                                    $tasks_student = $job->tasks;
                                                    foreach ($tasks_student as $task_student) {
                                                        $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                                        $count_news = $count_news + $news;
                                                    }
                                                @endphp
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/{{$job->student_id}}#card_unit{{$job->unit_id}}">{{$job->student->student_name}}</a></td>
                                                        <td class="text-center">{{$job->done_date->formatLocalized('%d. %B %Y')}}</td>
                                                        <td class="text-center">
                                                            @if($count_news > 0)
                                                            @php
                                                                session()->flash('unit_open',$job->unit_id);
                                                            @endphp
                                                                <a href="/lehrer/auftraege/schueler/{{$job->student_id}}#card_unit{{$job->unit_id}}"> 
                                                                    <span class="ml-3"><i class="fa-2x far fa-envelope"></i></span>
                                                                    <small><span class="badge news_notify badge-danger" style="position: relative; top:-20px; left:-12px;">{{$count_news}}</span></small>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($job->jobStatus_id < 3)
                                                                <form action="/lehrer/auftrag/zuteilen" method="post" enctype="multipart/form-data">
                                                                    @csrf @method('PATCH')
                                                                    <input type="hidden" name="firstjob_id" value="{{$job->id}}">
                                                                    <input type="hidden" name="studentgroup" value="0">
                                                                    <button title="Jetzt die Aufträge für  {{$job->student->student_name}} zuweisen und mit dem Lernen beginnen lassen" class="btn-sm" type="submit"><i class="fas fa-user-check"></i> Auftrag jetzt zuteilen</button>
                                                                </form>
                                                            @else 
                                                                <small>{{$job->jobStatus->jobStatus_name}}</small>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{--Modal zum Löschen--}}
                <div class="modal fade" id="deleteModal_{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    @include('components.deleteCheck',['typeDelete'=>'job','id'=>$job->id, 'title'=>$job->unit->unit_title])
                </div>
                {{-- Ende des Modal zum Löschen--}}
            @endif
        @endforeach
    @endisset

</div>


@endsection

@section('scripts')
@endsection