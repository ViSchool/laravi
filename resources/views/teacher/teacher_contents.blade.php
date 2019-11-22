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
    <p>Inhalte, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassen- und Schüleraccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du den Inhalt zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du den Inhalt in Deinen Lerneinheiten einsetzen. Lerneinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
     <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newContentModal">
Einen neuen Inhalt erstellen</button>

    <!-- Modal -->
  @component('teacher.teacher_components.newContentModal',['teacher'=>$teacher, 'tools'=>$tools, 'subjects'=>$subjects])   
  @endcomponent

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
    if (count($errors) > 0) {
        $('#newContentModal').modal('show');
    }
</script>  

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>

<script src="/js/dynamic_content_link.js"></script>

@endsection