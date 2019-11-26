@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
        <div class="container">
          	<h2>Lerninhalte administrieren</h2>
          	<a class="btn btn-primary"href="/backend/contents">Alle anzeigen</a>
		</div>
<div class="container">
	<div class="my-4">
	<p>Inhalte für das Fach 
		<a class="btn-sm btn-primary" href="/backend/contents/subjectfilter/{{$currentSubject->id}}">{{$currentSubject->subject_title}}
		</a>
	</p>	
	<p>Inhalte weiter nach Themen filtern:</p>
	@foreach($topics->sortBy('topic_title') as $topic)
		<a class="btn btn-info m-1" href="{{route('backend.contents.filtertopics' , ['topic' => $topic->id , 'subject' => $currentSubject->id])}}">{{$topic->topic_title}}</a>
		@endforeach
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Inhalts</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>Typ</th>
					<th>Test</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($contents as $content)
				<tr>
					<td><a href="{{route ('backend.contents.show',[$content->id])}}">{{$content->content_title}}</a></td>	
					<td>{{$content->topic->topic_title}}</td>
					<td>{{$content->subject->subject_title}}</td>
					<td>{{$content->type->content_type}}</td>
					<td><a href="/backend/questions/{{$content->id}}"><i class="far fa-question-circle"></i></a></td>
					<td>{{$content->status->status_name}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$contents->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/contents/create">Neuen Lerninhalt eintragen</a>
	
</div>
@endsection
