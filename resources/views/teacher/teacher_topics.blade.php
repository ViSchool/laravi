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
    <p>Themen, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt alle nur Du und die von Dir erstellten Klassenaccounts können dieses Thema sehen. Möchtest Du, dass das Thema auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du das Thema zur Veröffentlichung von der ViSchool freigeben lassen.</p>
</div>
<div class="container">
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Thema</th>
                <th colspan="2" scope="col">bearbeiten</th>
                <th scope="col">Status</th>
                <th scope="col">löschen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
             <tr>   
                <td>{{$topic->topic_title}}</td>
                <td>
                    @switch($topic->status_id)
                        @case(1)
                            <i class="text-muted fas fa-lock-open"></i>
                        @break
                        @case(2)
                            <i class="text-muted fas fa-hourglass-half"></i>
                        @break
                        @case(3)
                             <a href="/lehrer/newTopicViSchool/{{$topic->id}}">
                            <i class="fas fa-upload"></i></a> 
                        @break 
                        @default
                            <a href="/lehrer/newTopicPrivate/{{$topic->id}}"><i class="fas fa-user-check"></i></a>
                    @endswitch
                </td>
                <td>
                    @switch($topic->status_id)
                        @case(1)
                        @break
                        @case(2)
                        @break
                        @case(3)
                            An ViSchool zur Freigabe senden
                        @break 
                        @default
                            Privat veröffentlichen (Lehrerfreigabe)
                    @endswitch
                </td>
                <td>{{$topic->status->status_name}}</td>
                <td>
                    @if($topic->status_id != 1)
                <a href="/lehrer/newTopicDelete/{{$topic->id}}"><i class="fas fa-trash"></i></a>
                    @else
                        Thema ist bereits veröffentlicht, löschen ist nicht mehr möglich
                    @endif
                </td>
            @endforeach
            </tr>
            <tr>
                <td colspan="5"> <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#newTopicModal">
Ein neues Thema erstellen</button></td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="newTopicModal" tabindex="-1" role="dialog" aria-labelledby="newTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/themen" enctype="multipart/form-data">
                @csrf 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="neTopicModalLabel">Ein neues Thema erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        <div class="form-group{{ $errors->has('topic_title') ? ' has-error' : '' }}">
                            <label for="topic_title" class="col-md-4 control-label">Name des Themas</label>
                             <div class="col-10">
                             <input id="topic_title" type="text" class="form-control" name="topic_title" value="{{ old('topic_title') }}" required>
                                @if ($errors->has('topic_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('subject_id') ? ' has-error' : '' }}">
                            <label for="subject_id" class="col-md-4 control-label">Das Thema gehört zum Fach</label>
                             <div class="col-10">
                                <select id="subject_id" class="form-control" name="subject_id" required>
                                @if (old('subject_id') != NULL)   
                                <option value="{{ old('subject_id') }}">
                                    @php $old_subject = App\Subject::findOrFail(old('subject_id'));
                                    @endphp
                                    {{$old_subject->subject_title}}
                                </option>
                                @endif
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('subject_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject_id') }}</strong>
                                    </span>
                                @endif
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