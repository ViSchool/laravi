@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Lerneinheiten</h4>
    </div>
</section> 
@endsection

@section('content')



<div class="container mt-3">
    <h3>Deine selbst erstellten Lerneinheiten</h3>
    <p>"Lerneinheiten" sind fertige Unterrichtsblöcke, die Schüler selbständig benutzen und bearbeiten können. Du kannst sie im Unterricht einsetzen, aber auch als Hausaufgabe oder für das selbständige Lernen. Wenn Du verschiedene Lerneinheiten zusammenfassen willst, kannst Du sie einer Serie zuordnen. Dann können Schüler nacheinander die einzelnen Unterrichtseinheiten bearbeiten. 
    </p>
    <p>Lerneinheiten, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassenaccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du die Lerneinheit zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du die Unterrichtseinheit in Deinem Unterricht einsetzen. Unterrichtseinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
    <a class="btn btn-primary form-control" href="/lehrer/unterrichtseinheiten/erstellen">Eine neue Lerneinheit erstellen</a>
</div>

<!--Anzeige der Inhalte-->


<div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Lerneinheiten hast Du bereits erstellt:</h3>
    @foreach ($unitsBySubject as $subject_id => $units)
        @php $subject = App\Subject::findOrFail($subject_id);@endphp
        <h3 class="mt-3 text-brand-blue">{{$subject->subject_title}}</h3>           
        <div class="table">
            <table class="table-responsive-lg table-striped my-5 w-100">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Titel der Lerneinheit</th>
                        <th scope="col">Thema</th>
                        <th scope="col">gehört zur Serie</th>
                        <th class="text-center" scope="col">Anzahl <br> der <br> Aufgaben</th>
                        <th class="text-center" scope="col">Aktionen</th>
                        <th scope="col">Status</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $unit)
                    <tr class="p-5">   
                        <td >{{$unit->unit_title}}</td>
                        <td>{{$unit->topic->topic_title}}</td>
                        <td>
                            <div class="dropdown">
                                @if($unit->serie_id > 0)
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownSerieButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$unit->serie->serie_title}}</button>
                                @else
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownSerieButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Serie auswählen</button>
                                @endif
                                <div class="dropdown-menu mb-3" aria-labelledby="dropdownSerieButton" id="serie">
                                    @foreach ($series as $serie)
                                        <a class="dropdown-item" title="{{$serie->serie_description}}" href="/lehrer/unterrichtseinheiten/{{$unit->id}}/serie/{{$serie->id}}">{{$serie->serie_title}}</a> 
                                    @endforeach
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#serieModal_{{$unit->id}}">Neue Serie erstellen</button>     
                                </div>
                            </div>
                        </td>
                        <td class="text-center">{{$unit->blocks->count()}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion auswählen</button>
                                <div class="dropdown-menu mb-3" aria-labelledby="dropdownMenuButton" id="actions">
                                     @switch($unit->status_id)
                                        @case(1)
                                        @break
                                        @case(2)
                                        @break
                                        @case(3)
                                             <a class="dropdown-item" title="An Vischool zur Veröffentlichung senden" href="/lehrer/newUnitViSchool/{{$unit->id}}"><i class="fas fa-upload"></i> Veröffentlichung bei ViSchool </a> 
                                        @break 
                                        @default
                                            <a class="dropdown-item" title="Auf meiner privaten Lehrerseite veröffentlichen" href="/lehrer/newUnitPrivate/{{$unit->id}}"><i class="fas fa-user-check"></i> Auf meiner privaten Seite veröffentlichen</a>
                                    @endswitch

                                    @if($unit->status_id == 5)
                                        <a class="dropdown-item" title="Lerneinheit bearbeiten" href="/lehrer/unterrichtseinheiten/bearbeiten/{{$unit->id}}"><i class="far fa-edit"></i> Lerneinheit bearbeiten</a>
                                    @endif
                                    <button class="disabled dropdown-item" type="button" title="Eine Vorschau der Lerneinheit einblenden" data-toggle="modal" data-target="#previewModal"><i class="fas fa-glasses"></i> Vorschau</button>
                                    @if($unit->status_id > 2)
                                    <a class="dropdown-item" title="Aufgabe hinzufügen" href="/lehrer/unterrichtseinheiten/{{$unit->id}}/aufgabe"><i class="far fa-plus-square"></i> Aufgabe hinzufügen</a>
                                    <a class="dropdown-item" title="Aufgabe hinzufügen" href="/lehrer/unterrichtseinheiten/{{$unit->id}}/aufgaben"><i class="far fa-edit"></i> Aufgabe(n) bearbeiten</a>
                                    <button class="dropdown-item mb-3" type="button" title="Lerneinheit löschen" data-toggle="modal" data-target="#deleteModal_{{$unit->id}}"><i class="fas fa-trash"></i> Lerneinheit komplett löschen</button>
                                        {{--@include('components.deleteCheck',['typeDelete'=>'unit','id'=>$unit->id])--}}
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{$unit->status->status_name}}</td>
                    </tr>
                    
                    {{--Modal zum Löschen--}}
                    <div class="modal fade" id="deleteModal_{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        @include('components.deleteCheck',['typeDelete'=>'unit','id'=>$unit->id, 'title'=>$unit->unit_title])
                    </div>
                    {{-- Ende des Modal zum Löschen--}}

                    {{--Modal zum Speichern einer neuen Serie--}}
                    <div class="modal fade" id="serieModal_{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="serieModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="serieModalLabel">Serie erstellen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="unterrichtseinheiten/serie/erstellen">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="unit_id" name="unit_id" value="{{$unit->id}}">
                                        <div class="form-group{{ $errors->has('serie_title') ? ' has-error' : '' }}">
                                            <label for="serie_title" class="col-md-4 control-label">Name der Serie</label>
                                            <div class="col-10">
                                                <input id="serie_title" type="text" class="form-control" name="serie_title" value="{{ old('serie_title') }}" required>
                                                @if ($errors->has('serie_title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('serie_title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group {{$errors->has('serie_description') ? 'has-error' : '' }}">
                                            <label for="serie_description" class="col-md-4 control-label">Kurze Beschreibung zum Inhalt der Serie</label>
                                            <div class="col-10">
                                                <textarea id="serie_description" class="form-control" name="serie_description">{{ old('serie_description') }}</textarea>
                                                @if ($errors->has('serie_description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('serie_description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="sumbmit" class="btn btn-primary">Serie speichern</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--Ende des Modals zum Speichern der Serie--}}


                    @endforeach 
                </tbody>     
            </table>
        </div>
    @endforeach
</div>

@endsection

@section('scripts')  

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>

@endsection