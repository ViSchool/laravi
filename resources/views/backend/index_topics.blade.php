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
				</tr>
				@endforeach
			</tbody>
		</table>. 
		<ul class="pagination">{{$topics->links('vendor.pagination.bootstrap-4')}}</ul>
	</div>
@endsection
