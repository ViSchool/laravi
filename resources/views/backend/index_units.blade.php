@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <div><h2>Unterrichtseinheiten administrieren
          <a href="/backend/units/create"><i class="far fa-plus-square"></i></a></h2></div>
          

<div class="container">
	<div class="my-4">
	<p>Inhalte nach Fächern filtern:</p>
	@foreach($subjects->sortBy('subject_title') as $subject)
		<a class="btn btn-info m-1" href="/backend/units/subjectfilter/{{$subject->id}}">{{$subject->subject_title}}</a>
		@endforeach
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Unterrichtseinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($units as $unit)
				<tr>
					<td><a href="{{route ('backend.units.show',[$unit->id])}}">{{$unit->unit_title}}</a></td>	
					<td>{{$unit->topic->topic_title}}</td>
					<td>{{$unit->subject->subject_title}}</td>
					<td>@foreach ($unit->series as $serie)
						@isset($serie->id)
						{{$serie->serie_title}}
						@endisset
						@endforeach
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$units->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Unterrichtseinheit erstellen</a>
	
</div>
@endsection
