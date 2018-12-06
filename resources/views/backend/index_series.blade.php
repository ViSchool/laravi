@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h4>Serien mit Unterrichtseinheiten administrieren</h4>

<div class="container">
	<p>Hier sind alle Serien mit einzelnen Unterrichtseinheiten gelistet</p>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Titel der Serie</th>
					<th>Anzahl zugehöriger Unterrichtseinheiten</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($series as $serie)
				<tr>
					<td>{{$serie->id}}</td>
					<td><a href="/backend/series/{{$serie->id}}">{{$serie->serie_title}}</a></td>	
					<td>
					@php
					$units = $serie->units->count();
					@endphp 
					{{$units}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$series->links('vendor.pagination.bootstrap-4')}}
		<hr></hr>
	<a class="btn btn-primary"href="/backend/series/create">Neue Serie erstellen</a>
</div>
@endsection
