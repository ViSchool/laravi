@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Freizugebende Inhalte</h1>

<div class="container">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Typ</th>
					<th>Titel</th>
					<th>Lehreraccount</th>
					<th>Status ändern</th>
				</tr>
			</thead>
			{{-- Inhalte --}}
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Inhalte</th>
				</tr>
				@if (count($status->contents) == 0)
					<td colspan="4"> Aktuell keine Inhalte zum freigeben</td>	 	
				@else
					@foreach ($status->contents as $content)
						<tr>
							<td><small>{{$content->type->content_type}}</small></td>
							<td><a href="/backend/contents/{{$content->id}}"><small>{{$content->content_title}}</small></a></td>
							<td><small>{{$content->user->user_name}}</small></td>
							<td><a class="btn-sm btn-primary" href="/backend/contents/adminapproval/{{$content->id}}">Freigeben</a></td>
						</tr>
					@endforeach
				@endif
			</tbody>

			{{-- Themen --}}
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Themen</th>
				</tr>
				@if (count($status->topics) == 0)
					<td colspan="4"> Aktuell keine Themen zum freigeben</td>	 	
				@else
					@foreach ($status->topics as $topic)
						<tr>
							<td><small>Thema</small></td>
							<td><a href="/backend/topics/{{$topic->id}}"><small>{{$topic->topic_title}}</small></a></td>
							<td><small>{{$topic->user->user_name}}</small></td>
							<td><a class="btn-sm btn-primary" href="/backend/topics/approve/{{$topic->id}}">Freigeben</a></td>	
						</tr>
					@endforeach
				@endif
			</tbody>

			{{-- Lerneinheiten --}}
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Lerneinheiten</th>
				</tr>
				@if (count($status->units) == 0)
					<td colspan="4"> Aktuell keine Lerneinheiten zum freigeben</td>	 	
				@else
					@foreach ($status->units as $unit)
						<tr>
							<td><small>Lerneinheit</small></td>
							<td><small>{{$unit->unit_title}}</small></td>
							<td><small>{{$unit->user->user_name}}</small></td>
							<td><a class="btn-sm btn-primary" href="/backend/units/approve/{{$unit->id}}">Freigeben</a></td>	
						</tr>
					@endforeach
				@endif
			</tbody>

			{{-- Serien --}}
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Serien</th>
				</tr>
				@if (count($status->series) == 0)
					<td colspan="4"> Aktuell keine Serien zum freigeben</td>	 	
				@else
					@foreach ($status->series as $serie)
						<tr>
							<td><small>Lerneinheit</small></td>
							<td><small>{{$serie->serie_title}}</small></td>
							<td><small>{{$serie->user->user_name}}</small></td>
							<td><a class="btn-sm btn-primary" href="/backend/series/approve/{{$serie->id}}">Freigeben</a></td>	
						</tr>
					@endforeach
				@endif
			</tbody>



      </table>
	</div>
</div>
@endsection
