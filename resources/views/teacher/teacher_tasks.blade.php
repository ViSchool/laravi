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
      <h3>Von Dir zugewiesene Aufträge</h3>
      <p>"Aufträge" sind öffentliche oder private Lerneinheiten, die Du einzelnen Schülern oder ganzen Klassen zur Erledigung zuweisen kannst. Wenn Du einen Auftrag erstellst, dann bekommt jeder Schüler einen entsprechenden Eintrag auf seiner Auftragsliste und kann Dir danach seine Ergebnisse freigeben.  </p>
      <p>Aufträge, die Du erstellst, können nur die Schüler sehen, denen Du Aufträge erteilt hast. </p>
   </div>
   <div class="container">
      <a class="btn btn-primary form-control" href="/lehrer/auftrag/erstellen">Einen neuen Auftrag erstellen</a>
   </div>

   <div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Aufträge hast Du bereits erstellt:</h3>

    @isset($tasksByStudentgroup)
        @foreach ($tasksByStudentgroup as $studentgroup_id  => $tasksByUnits)
            @if ($studentgroup_id !== "")
                @php
                    $studentgroup = App\Studentgroup::findOrFail($studentgroup_id);
                @endphp
                    
                
                <h3 class="mt-3 text-brand-blue">Aufträge an Klasse: "{{$studentgroup->studentgroup_name}}"</h3>           
                     
                <div class="accordion" id="accordion_{{$studentgroup->id}}">
                    @foreach ($tasksByUnits as $unit_id => $tasks)
                        @php
                            $unit = App\Unit::findOrFail($unit_id);
                        @endphp
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}_{{$studentgroup->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}_{{$studentgroup->id}}">
                                    {{$unit->unit_title}}                                        
                                </button></h2>
                            </div>

                            <div id="collapse_{{$unit->id}}_{{$studentgroup->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_{{$studentgroup->id}}">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th>zu erledigen bis</th>
                                                <th>Nachrichten</th>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $tasks_unique = $tasks->unique('student_id');
                                                @endphp
                                                @foreach ($tasks_unique as $task)
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/{{$task->student->id}}">{{$task->student->student_name}}</a></td>
                                                        <td>{{$task->done_date}}</td>
                                                        <td>$task->student->results->count()</td>
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
                    @foreach ($tasksByUnits as $unit_id => $tasks)
                        @php
                            $unit = App\Unit::findOrFail($unit_id);
                        @endphp
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}">
                                    {{$unit->unit_title}}                                        
                                </button></h2>
                            </div>

                            <div id="collapse_{{$unit->id}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion_singleStudent">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th>zu erledigen bis</th>
                                                <th>Nachrichten</th>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $tasks_unique = $tasks->unique('student_id');
                                                @endphp
                                                @foreach ($tasks_unique as $task)
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/{{$task->student->id}}">{{$task->student->student_name}}</a></td>
                                                        <td>{{$task->done_date}}</td>
                                                        <td>$task->student->results->count()</td>
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
                <div class="modal fade" id="deleteModal_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    @include('components.deleteCheck',['typeDelete'=>'task','id'=>$task->id, 'title'=>$task->block->unit->unit_title])
                </div>
                {{-- Ende des Modal zum Löschen--}}
            @endif
        @endforeach
    @endisset

</div>


@endsection

@section('scripts')
@endsection