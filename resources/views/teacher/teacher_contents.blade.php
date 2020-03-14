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
        <table class="table table-responsive-md table-striped my-5 w-100">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Name des Inhalts</th>
                    <th scope="col">Thema</th>
                    <th scope="col">Tool/Hoster</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aktionen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                    <tr class="m-0 p-0">
                        <td><button class="btn btn-link m-0 p-0 text-left" data-toggle="modal" data-target="#editContentModal_{{$content->id}}">{{$content->content_title}}</button></td>
                        <td><small> {{$content->topic->topic_title}}</small></td>
                        <td><small> {{$content->tool->tool_title}}</small></td>
                        <td><small> {{$content->status->status_name}}</small></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion auswählen</button>
                                <div class="dropdown-menu mb-3" aria-labelledby="dropdownMenuButton" id="content_actions">
                                    @switch($content->status_id)
                                        @case(1)
                                        @break
                                        @case(2)
                                        @break
                                        @case(3)
                                            <a class="dropdown-item" title="An Vischool zur Veröffentlichung senden" href="/lehrer/newContentViSchool/{{$content->id}}"><i class="fas fa-upload"></i> Veröffentlichung bei ViSchool </a> 
                                        @break 
                                        @default
                                            <a class="dropdown-item" title="Auf meiner privaten Lehrerseite veröffentlichen" href="/lehrer/newContentPrivate/{{$content->id}}"><i class="fas fa-user-check"></i> Auf meiner privaten Seite veröffentlichen</a>
                                    @endswitch
                                    
                                    @if($content->status_id > 2)
                                        <button class="btn btn-link dropdown-item text-left text-black" data-toggle="modal" data-target="#editContentModal_{{$content->id}}"><i class="far fa-edit"></i> Inhalt bearbeiten</button>
                                    @endif
                                    
                                   
                                    @if($content->status_id > 2)
                                        <button type="button" class="btn btn-link dropdown-item" data-toggle="modal" data-target="#deleteModal_{{$content->id}}"><i class="far fa-trash-alt"></i> Inhalt löschen</button>
                                        
                                    @endif
                                </div>
                            </div>
                        </td>            
                    </tr>
                    <tr>        
                    </tr>
                    <div class="modal fade" id="deleteModal_{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        @include('components.deleteCheck',['typeDelete'=>'content','id'=>$content->id,'title'=>$content->content_title])
                    </div>
                    @component('teacher.teacher_components.editContentModal',['content'=>$content, 'teacher'=>$teacher, 'tools'=>$tools, 'subjects'=>$subjects])   
                    @endcomponent
                @endforeach
            </tbody>
        </table>				
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