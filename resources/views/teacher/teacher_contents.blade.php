@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Inhalte</h4>
    </div>
</section> 
@endsection

@section('content')



<div class="container mt-3">
    <h3>Deine selbst erstellten Inhalte</h3>
    <p>"Inhalte" sind einzelne Videos oder Aufgaben, die Du im Internet findest oder selbst erstellt und bei einem anderen Dienst speicherst. Typische Beispiele sind Youtube- oder Vimeo-Videos, h5p-Aufgaben oder andere Aufgaben auf Webseiten. Um einen Inhalt selbst einzustellen, brauchen wir zunächst nur den Link, mit dem der Inhalte dargestellt wird. Je mehr Informationen Ihr uns dabei gebt, desto besser können wir den Inhalt erkennen und einbinden. Sollte das einmal nicht klappen, keine Sorge: Wir schauen uns alle Inhalte noch einmal an und korrigieren falls nötig. 
    </p>
    <p>Inhalte, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassenaccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du den Inhalt zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du den Inhalt in Deinen Unterrichtseinheiten einsetzen. Unterrichtseinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
     <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newContentModal">
Einen neuen Inhalt erstellen</button>






    <!-- Modal -->
    <div class="modal fade" id="newContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/inhalte" enctype="multipart/form-data">
                @csrf 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newContentModalLabel">Einen neuen Inhalt erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        
                        <input type="hidden" 
                            @if ($teacher->teacher_id == $teacher->id)
                                value="teacher" 
                            @else 
                                value="student"
                            @endif
                        name="teacherOrStudent">


                        <div class="form-group{{ $errors->has('content_title') ? ' has-error' : '' }}">
                            <label for="content_title" class="col-10 control-label">Name des Inhalts</label>
                             <div class="col-10">
                             <input id="content_title" type="text" class="form-control" name="content_title" value="{{ old('content_title') }}" required>
                                @if ($errors->has('content_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tool_id') ? ' has-error' : '' }}">
                            <label for="content_provider" class="col-10 control-label">Der Inhalt stammt von folgendem Anbieter:</label>
                            <div class="col-10">
                                <select class="form-control" id="tool_id" name="tool_id">
				                    @if((old('tool_id')) !== null)
                                        @php 
                                            $tool_id_old = old('tool_id');
                                            $tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
                                        @endphp
                                        <option value="{{$tool_id_old}}">{{$tool_old->tool_title}}</option>
				                    @endif
				                    @empty(old('tool_id'))
					                    <option value=""></option>
				                    @endempty
				                    @foreach ($tools as $tool)	
					                    <option value="{{$tool->id}}">{{$tool->tool_title}}</option>
                                    @endforeach
                                        <option value="">Anderer Anbieter</option>
                                </select>
                            </div>    
                        </div>

                        <div class="form-group{{ $errors->has('content_link') ? ' has-error' : '' }}">
                            <label for="content_link" class="col-10 control-label">Link zum Inhalt</label>
                            <br>
                            <small id="examplelink" class="text-muted col-10">Beispiellink</small>
                             <div class="col-11">
                                <input id="content_link" type="text" class="form-control" name="content_link" value="{{ old('content_link') }}" placeholder="" required>
                                @if ($errors->has('content_link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('subject_id') ? ' has-error' : '' }}">
                            <label for="topic_id" class="col-10 control-label">Der Inhalt gehört zu folgendem Fach</label>
                             <div class="col-10">
                               <select class="form-control" id="subject_id" name="subject_id">
				                    @if((old('subject_id')) !== null)
                                        @php 
                                            $subject_id_old = old('subject_id');
                                            $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                        @endphp
                                        <option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
				                    @endif
				                    @empty(old('subject_id'))
					                    <option value=""></option>
				                    @endempty
				                    @foreach ($subjects as $subject)	
					                    <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				                    @endforeach
                             </select>
            @if ($errors->has('topic_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('topic_id') ? ' has-error' : '' }}">
                            <label for="topic_id" class="col-10 control-label">Der Inhalt gehört zu folgendem Thema</label>
                             <div class="col-10">
                                <select class="form-control" id="topic_id" name="topic_id">
                                    @if((old('topic_id')) !== null)
                                        @php 
                                            $topic_id_old = old('topic_id');
                                            $topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
                                        @endphp
                                        <option value="{{$topic_id_old}}">{{$topic_old->topic_title}}</option>
                                    @endif
                                    @empty(old('topic_id'))
                                        <option>Zuerst Fach auswählen</option>
                                    @endempty
                                </select>
			                    <div class="col-md-2">
				                    <span id="loader" style="visibility: hidden;">
					                    <i class="far fa-spinner fa-spin"></i>
				                    </span>
			                    </div>
                                @if ($errors->has('topic_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>         
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Inhalt speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Anzeige der Inhalte-->


<div class="container my-4">
    <hr> 
    <h3>Diese Inhalte hast Du bereits erstellt:</h3>
    @foreach ($contentsBySubject as $subject_id => $contents)
    @php $subject = App\Subject::findOrFail($subject_id);@endphp
        <h3 class="mt-3 text-brand-blue">{{$subject->subject_title}}</h3>
        <div class="row justify-content-start">
            
            @foreach ($contents as $content)
            <div class="col">
				<div class="card m-3" style="width:200px">
					@isset ($content->content_img_thumb)
						<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
					@endisset
					@empty ($content->content_img_thumb) 
						@switch($content->tool_id)
							@case(1)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
							@break
							@case(7)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="{{$content->img_thumb_url}}"></img></a>
							@break
							@default
								@isset ($content->portal->portal_img)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/portals/{{$content->portal->portal_img}}"></img></a>
								@endisset
						@endswitch
					@endempty	
					<div class="card-body">
						<a href="/content/{{$content->id}}"><h4 class="card-title">{{$content->content_title}}</h4></a>
						<p class="card-text">
                            @php 
                            $reviews = App\Review::where('content_id',$content->id)->get();
                            $average_score = $reviews->avg('overall_score');
                            @endphp
                            <!-- Sternchenbewertung auf Inhalte-Card -->
                            @if ($average_score > 0)
                                @php $rating = $average_score @endphp  
                                @foreach(range(1,5) as $i)
                                    <span class="fa-stack" style="width:1em" data-toggle="tooltip" data-placement="top" title="Durchschnittliche Bewertung">
                                        <i class="far fa-star fa-stack-1x"></i>

                                        @if($rating >0)
                                            @if($rating >0.5)
                                                <i class="fas fa-star fa-stack-1x"></i>
                                            @else
                                                <i class="fas fa-star-half fa-stack-1x"></i>
                                            @endif
                                        @endif
                                        @php $rating--; @endphp
                                    </span>
                                @endforeach
                            @endif
                        </p>
                    </div>
  					
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted">
                            <i class="{{$content->type->type_icon}} "></i>
                            {{$content->type->content_type}}
                        </small>
                          
                    </div>
                    <div class="card-footer 
                    @if ($content->status_id == 5)
                        bg-warning 
                    @elseif ($content->status_id == 4)
                        bg-info text-white
                    @elseif ($content->status_id == 3)
                        bg-warning 
                    @elseif ($content->status_id == 2)
                        bg-info text-white
                    @elseif ($content->status_id == 1)
                        bg-success text-white
                    @endif                        
                    d-flex justify-content-between">
                        <small>
                            <i class="{{$content->status->status_icon}}"></i>
                            {{$content->status->status_name}}
                        </small> 
                        @if ($content->status_id == 5)
                            <a title="Inhalt bestätigen und auf der privaten Seite veröffentlichen" href="/lehrer/newContentPrivate/{{$content->id}}"><i class="fas fa-thumbs-up"></i></a>
                        @elseif ($content->status_id == 3)
                            <small><a title="An ViSchool zur Veröffentlichung schicken" href="/lehrer/newContentViSchool/{{$content->id}}" ><i class="fas fa-upload"></i></a></small>
                        @endif
                    </div>	
                </div>
            </div>  
            @endforeach
        </div> 
        <hr>   
    @endforeach  
	
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#newTopicModal').modal('show');
    @endif
</script>  

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>

<script src="/js/dynamic_content_link.js"></script>
@endsection