@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4 class="mb-4"> Serie "{{$serie->serie_title}}" bearbeiten</h4>

<div class="container">
	@include('layouts.errors')
	
	<form method="POST" action="{{route('series.update',$serie->id)}}">
		{{ csrf_field() }} {{ method_field('PATCH') }}
		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="{{$serie->serie_title}}">
		</div>
		<div class="form-group">
			<label for="serie_description">Kurzbeschreibung/Ziel der Unterrichtsserie:</label>
			<textarea class="form-control" id="serie_description" name="serie_description" aria-label="serie_description" aria-describedby="serie_description">{{$serie->serie_description}}</textarea>
		</div>
		
		<div class="form-group">
			<label for="public">Sichtbarkeit der Serie:</label>
			<select class="form-control" id="public" name="public">
				@if($serie->public == 0)
				<option value="0">nur Backend</option>
				<option value="1">Frontend und Backend</option>
				@else
				<option value="1">Frontend und Backend</option>
				<option value="0">nur Backend</option>
				@endif
			</select>
		</div>	
		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	
	</form>
	<hr></hr>
		<div class="form-group">
			<form method="POST" action="{{route('series.destroy',[$serie->id])}}">
				{{ csrf_field() }} {{ method_field('DELETE') }}
					<button class="btn btn-warning" type="submit"> Serie komplett löschen</button>
			</form>
		</div>
</div>

<hr></hr>
<div class = "container">
<h4>Unterrichtseinheiten zur Serie {{$serie->serie_title}}</h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name der Unterrichtseinheiten</th>
					<th>Anzahl der Aufgaben in der Einheit</th>
				</tr>
			</thead>
			<tbody>
				@foreach($serie->units as $unit)
				<tr>
					<td><a href="/backend/units/{{$unit->id}}">{{$unit->unit_title}}</a></td>
					@php $blocksCount = $unit->blocks->count(); @endphp	
					<td>{{$blocksCount}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
</div>
@endsection
