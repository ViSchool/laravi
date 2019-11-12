@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Themen administrieren</h1>

<div class="container">
	<a href="/backend/topics/create" class="btn btn-primary mb-3">Neues Thema eintragen</a>
	<hr></hr>
	<p><h4>Eingetragene Themen</h4></p>
		<table class="table">
			<thead>
				<tr>
					<th class="text-muted">ID</th>
					<th>Name des Themas</th>
					<th>Fächer</th>
					<th>Status</th>
					<th>Freigeben/Löschen</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($topics as $topic)
				<tr>
					<td class="text-muted">{{$topic->id}}</td>
					<td><a href="/backend/topics/{{$topic->id}}">{{$topic->topic_title}}</a></td>	
					<td>@foreach ($topic->subjects as $subject)
						<p>{{$subject->subject_title}}</p>
						@endforeach
					</td>
					<td class="text-center"><i class="{{$topic->status->status_icon}}"></i>{{$topic->status->status_name}}</td>								
					<td class="text-center">@if($topic->status_id == 2)
							<a href="/backend/topics/approve/{{$topic->id}}">
							<i class="far fa-thumbs-up"></i></a>
						@endif
						@if($topic->status_id == 5)
							@if ($topic->user_id == NULL)
							<a href="/backend/topics/approve/{{$topic->id}}">
							<i class="far fa-thumbs-up"></i></a>
							@endif
						@endif
						@if($topic->status_id == 1)
                		<a href="/lehrer/newTopicDelete/{{$topic->id}}"><i class="fas fa-trash"></i></a>
                  @endif		
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>. 
		<ul class="pagination">{{$topics->links()}}</ul>
	</div>
@endsection
