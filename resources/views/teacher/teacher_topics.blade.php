@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Themen</h4>
    </div>
</section> 
@endsection

@section('content')



<div class="container mt-3">
    <h3>Deine selbst erstellten Themen</h3>
    <p>"Themen" sind die Überschriften unter denen bestimmte Inhalte und Unterrichtseinheiten zusammengefasst werden. Beispiele findest Du auf der ViSchool Seite. Wenn Dir Themen auf unserer Seite fehlen, zu denen Du gerne Inhalte anlegen möchstest, dann kannst Du sie hier erstellen und siehst auch die Übersicht der Themen, die Du bereits erstellt hast.
    </p>
    <p>Themen, die Du erstellst, findest Du zunächst nur in Deinem Lehrerbereich unter "Meine Themen". Willst Du sie nur Deiner Klasse anzeigen, kannst Du sie "privat veröffentlichen". Ändere dazu den Status hier auf der Seite. Dann können nur Du und die von Dir erstellten Klassen-/Schüleraccounts dieses Thema auf der ViSchool-Seite sehen. Möchtest Du, dass das Thema auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du das Thema zur Veröffentlichung von der ViSchool freigeben lassen.</p>
</div>
<div class="container">
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Thema bearbeiten</th>
                <th scope="col">Fächer</th>
                <th scope="col"> Status bearbeiten</th>
                <th scope="col">Status</th>
                <th scope="col">löschen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
            @php
                $currentSubjects = $topic->subjects->pluck('subject_title')->all();
            @endphp
             <tr>   
                <td>
                    <button type="button" class="p-0 m-0 btn btn-link" data-toggle="modal" data-target="#editTopicModal">
                        {{$topic->topic_title}}
                    </button>
                </td>

                    <!-- Modal Thema bearbeiten -->
                    <div class="modal fade" id="editTopicModal" tabindex="-1" role="dialog" aria-labelledby="newTopicModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form method="POST" action="/lehrer/themen/bearbeiten/{{$topic->id}}" enctype="multipart/form-data">
                                @csrf 
                                                
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editTopicModalLabel">Thema "{{$topic->topic_title}}" bearbeiten</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">    
                                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                                        <div class="form-group{{ $errors->has('topic_title') ? ' invalid' : '' }}">
                                            <label for="topic_title" class="col-md-4 col-form-label">Name des Themas</label>
                                            <div class="col-10">
                                            <input id="topic_title" type="text" class="form-control" name="topic_title" value="{{$topic->topic_title}}" required>
                                                @if ($errors->has('topic_title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('topic_title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
		                                    <label>Fach/Fächer auswählen:</label>
			                                <div class="card">
				                                <div style="column-count: 3">
					                                @foreach ($subjects as $subject)	
						                                <div class="form-check mx-2">
							                                <input type="checkbox" class="form-check-input mt-2" id="{{$subject->id}}" value="{{$subject->id}}" name="subjects[]" @if (in_array($subject->subject_title, $currentSubjects)) checked @endif>
							                                <label class="font-weight-normal form-check-label ml-4" for="">{{$subject->subject_title}}</label>
                                                        </div>
                                                        @if ($errors->has('subject_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('subject_id') }}</strong>
                                                            </span>
                                                        @endif
					                                @endforeach
				                                </div>
			                                </div>
		                                </div>        
                                    </div>    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                        <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                <td>
                    @foreach ($topic->subjects as $subject)
                        {{$subject->subject_title}}
                    @endforeach
                </td>
                <td>
                    @switch($topic->status_id)
                        @case(1)
                        @break
                        @case(2)
                        @break
                        @case(3)
                            <a href="/lehrer/newTopicViSchool/{{$topic->id}}">    
                                An ViSchool zur Freigabe senden
                            </a>
                        @break 
                        @default
                            <a href="/lehrer/newTopicPrivate/{{$topic->id}}">
                                Privat veröffentlichen (Lehrerfreigabe)
                            </a>
                    @endswitch
                </td>
                <td>{{$topic->status->status_name}}</td>
                <td class="text-center">
                    @if($topic->status_id != 1)
                        <a href="/lehrer/newTopicDelete/{{$topic->id}}"><i class="fas fa-trash"></i></a>
                    @else
                        Thema ist bereits veröffentlicht, löschen ist nicht mehr möglich
                    @endif
                </td>
            @endforeach
            </tr>
            <tr>
                <td colspan="5"> 
                    <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#newTopicModal">
                        Ein neues Thema erstellen
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="newTopicModal" tabindex="-1" role="dialog" aria-labelledby="newTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/themen/speichern" enctype="multipart/form-data">
                @csrf             
                    <div class="modal-header">
                        <h5 class="modal-title" id="neTopicModalLabel">Ein neues Thema erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        <div class="form-group{{ $errors->has('topic_title') ? ' invalid' : '' }}">
                            <label for="topic_title" class="col-6 col-form-label">Name des Themas</label>
                            <div class="col-10">
                                <input id="topic_title" type="text" class="form-control" name="topic_title" value="{{ old('topic_title') }}" required>
                                @if ($errors->has('topic_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
		                    <label for="subjects" class="col-6 col-form-label">Fach/Fächer auswählen:</label>
                                <div class="card">
				                    <div style="column-count: 3">
					                    @foreach ($subjects as $subject)	
						                    <div class="form-check">
							                    <input type="checkbox" class="form-check-input mt-2" id="{{$subject->id}}" value="{{$subject->id}}" name="subjects[]">
							                    <label class="font-weight-normal form-check-label ml-4" for="">{{$subject->subject_title}}</label>
                                            </div>
                                            @if ($errors->has('subject_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                                </span>
                                            @endif
					                    @endforeach
				                    </div>
                                </div>
                            </div>                          
                        </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Thema speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</div>
@endsection

@section('scripts')
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#newTopicModal').modal('show');
    @endif
</script>  
@endsection