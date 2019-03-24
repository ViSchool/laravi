@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lehreraccount von {{$teacher->teacher_name}} {{$teacher->teacher_surname}} Übersicht</h1>

<div class="container">
	<h3>Zugeordnete Schüleraccounts</h3>
	<table class="table">
		<thead>
			<tr>
				<th>Benutzername des Schülers</th>
				<th>Schule</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($students as $student)
				<tr>
					<td>{{$student->user_name}}</td>	
					<td>{{$student->school}}</td>							
				</tr>
			@endforeach
		</tbody>
	</table> 
</div>
<hr>
<div class="container">
	<h3>Zugeordnete Klassenaccounts</h3>
	<table class="table">
		<thead>
			<tr>
				<th>Benutzername für die Klasse</th>
				<th>Schule</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($classes as $class)
				<tr>
					<td>{{$class->user_name}}</td>	
					<td>{{$class->school}}</td>							
				</tr>
			@endforeach
		</tbody>
	</table> 
</div>
@endsection
