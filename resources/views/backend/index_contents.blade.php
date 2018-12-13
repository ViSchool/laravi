@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <div><h2>Lerninhalte administrieren
          <a href="/backend/contents/create"><i class="far fa-plus-square"></i></a></h2></div>
          

<div class="container">
	<div class="my-4">
	<p>Inhalte nach Fächern filtern:</p>
	@foreach($subjects->sortBy('subject_title') as $subject)
		<a class="btn btn-info m-1" href="/backend/contents/subjectfilter/{{$subject->id}}">{{$subject->subject_title}}</a>
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
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$contents->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/contents/create">Neuen Lerninhalt eintragen</a>
	
</div>
@endsection
