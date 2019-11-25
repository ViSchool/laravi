@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lehreraccounts Übersicht</h1>

<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th class="text-muted">Email</th>
				<th>Name des Lehrers</th>
				<th>Schule</th>
				<th>Premiumaccount?</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($teachers as $teacher)
				<tr>
					<td class="text-muted">{{$teacher->email}}</td>
					<td><a href="/backend/teacher/{{$teacher->id}}">{{$teacher->teacher_name}} {{$teacher->teacher_surname}}</a></td>	
					<td>{{$teacher->school}}</td>
					<td>
						@if ($teacher->hasRole('Lehrer (premium)'))
							<i class="fas fa-euro-sign"></i><i class="fas fa-euro-sign"></i> ja
						@else
							<i class="fab fa-creative-commons-nc-eu"></i> nein
						@endif
					</td>								
				</tr>
			@endforeach
		</tbody>
	</table> 
</div>
@endsection
