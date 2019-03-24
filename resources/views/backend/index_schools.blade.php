@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Schulen administrieren</h1>

<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Schule</th>
				<th>Stadt</th>
				<th>Schultyp</th>
				<th>ViSchool Schul-URL</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($schools as $school)
				<tr>
					<td><a href="/backend/schools/{{$school->id}}">{{$school->school_name}}</a></td>
					<td>{{$school->school_city}}</td>	
					<td>{{$school->school_type}}</td>
					<td>{{$school->school_vischoolUrl}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{$schools->links()}}
	<hr>
	<a class="btn btn-primary"href="/backend/schools/create">Neue Schule eintragen</a>
</div>
@endsection
