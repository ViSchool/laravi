@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Fächer administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Fach</th>
					<th>Icon</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($subjects as $subject)
				<tr>
					<td>{{$subject->id}}</td>
					<td><a href="/backend/subjects/{{$subject->id}}">{{$subject->subject_title}}</a></td>	
					<td><i class="fa {{$subject->subject_icon}}"></i></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$subjects->links('vendor.pagination.bootstrap-4')}}
		<hr></hr>
	<a class="btn btn-primary"href="/backend/subjects/create">Neues Fach eintragen</a>
</div>
@endsection
