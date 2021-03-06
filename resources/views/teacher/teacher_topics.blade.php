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

@if (Session::has('message'))
   <div class="alert alert-warning">{{ Session::get('message') }}</div>
@endif

<div class="container mt-3">
    <h3>Deine selbst erstellten Themen</h3>
    <p>"Themen" sind die Überschriften unter denen bestimmte Inhalte und Lerneinheiten zusammengefasst werden. Beispiele findest Du auf der ViSchool Seite. Wenn Dir Themen auf unserer Seite fehlen, zu denen Du gerne Inhalte anlegen möchstest, dann kannst Du sie hier erstellen und siehst auch die Übersicht der Themen, die Du bereits erstellt hast.
    </p>
    <p>Themen, die Du erstellst, findest Du zunächst nur in Deinem Lehrerbereich unter "Meine Themen". Wenn Du ein neues Thema anlegst, dann stellen wir dies nach einer kurzen Prüfung direkt für andere Lehrer auch zur Verfügung. So lange wir das Thema noch nicht komplett freigegeben haben, kannst Du es noch ändern. Das verhindert, dass zuviele gleiche Themen angelegt werden. Du findest das Thema weiterhin bei Deinen Themen, Änderungen kannst Du aber nicht mehr vornehmen. Wenn Du ein weiteres Thema benötigst, welches noch fehlt, lege einfach noch eins an.</p>
</div>
<div class="container">
    <table class="table table-responsive-sm table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Thema bearbeiten</th>
                <th scope="col">Fächer</th>
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
                     @if($topic->status_id != 1)
                        <button type="button" class="btn btn-link text-center" data-toggle="modal" data-target="#editTopicModal_{{$topic->id}}">
                            {{$topic->topic_title}}
                        </button>
                    @else
                       <small class="btn"> {{$topic->topic_title}} </small>
                    @endif
                </td>

                    <!-- Modal Thema bearbeiten -->
                    <div class="modal fade" id="editTopicModal_{{$topic->id}}" tabindex="-1" role="dialog" aria-labelledby="editTopicModalLabel" aria-hidden="true">
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
                <td>{{$topic->status->status_name}}</td>
                <td class="text-center">
                    @if (count($topic->unit) > 0)
                        <small class="text-secondary">Zu diesem Thema gibt es noch Lerneinheiten, Du kannst es deshalb nicht löschen. </small>
                        @elseif($topic->status_id != 1)
                        {{-- <a href="/lehrer/newTopicDelete/{{$topic->id}}"><i class="fas fa-trash"></i></a> --}}
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deleteModal_{{$topic->id}}"><i class="far fa-trash-alt"></i></button>
                            <div class="modal fade" id="deleteModal_{{$topic->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                @include('components.deleteCheck',['typeDelete'=>'topic','id'=>$topic->id,'title'=>$topic->topic_title])
                            </div>
                        @else
                            <small> Thema ist bereits veröffentlicht, Löschen ist nicht mehr möglich </small>
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
                        <div class="form-group{{ $errors->has('subjects') ? ' invalid' : '' }}">
		                    <label for="subjects" class="col-6 col-form-label">Fach/Fächer auswählen:</label>
                                <div class="card">
				                    <div style="column-count: 3">
					                    @foreach ($subjects as $subject)	
						                    <div class="form-check">
							                    <input type="checkbox" class="form-check-input mt-2" id="{{$subject->id}}" value="{{$subject->id}}" name="subjects[]">
							                    <label class="font-weight-normal form-check-label ml-4" for="">{{$subject->subject_title}}</label>
                                            </div>
                                            @if ($errors->has('subjects'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('subjects') }}</strong>
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