@extends ('backend.layout_backend')

@section('main')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
	<div class="container">
		<h2>Lerneinheiten administrieren</h2>
		<a class="btn btn-primary"href="/backend/units">Alle anzeigen</a>
	</div>

	<div class="container">
		<div class="my-4">
			<p>Lerneinheiten für das Fach 
				<a class="btn-sm btn-primary" href="/backend/units/subjectfilter/{{$currentSubject->id}}">{{$currentSubject->subject_title}}
				</a>
			</p>	
		<hr></hr>
			<p>Andere Themen: </p>
			@foreach ($topics as $topic)
				<a class="btn btn-info m-1" href="{{route('backend.units.filtertopics',['topic' => $topic->id , 'subject' => $currentSubject->id])}}">{{$topic->topic_title}}</a>
			@endforeach
		</div>
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Titel der Lerneinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($units as $unit)
				<tr>
					<td><a href="{{route ('backend.units.show',[$unit->id])}}">{{$unit->unit_title}}</a></td>	
					<td>{{$unit->topic->topic_title}}</td>
					<td>{{$unit->subject->subject_title}}</td>
					<td>
						@if ($unit->serie_id !== NULL)
						{{$unit->serie->serie_title}}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$units->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Lerneinheit erstellen</a>
	
</div>
@endsection
