@extends ('backend.layout_backend')

@section('stylesheets')
	
@endsection

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h4>Serien mit Unterrichtseinheiten administrieren</h4>

<div class="container">
	<p>Hier sind alle Serien mit einzelnen Unterrichtseinheiten gelistet</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel der Serie</th>
					<th>Anzahl zugehöriger Unterrichtseinheiten</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($series as $serie)
				<tr>
					<td><a href="/backend/series/{{$serie->id}}">{{$serie->serie_title}}</a></td>	
					<td><i class="{{$serie->status->status_icon}}"></i><br>{{$serie->status->status_name}}</td>
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
		{{$series->links()}}
		<hr></hr>
	<a class="btn btn-primary"href="/backend/series/create">Neue Serie erstellen</a>
</div>
@endsection

