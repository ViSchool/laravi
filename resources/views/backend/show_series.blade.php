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
		
		<div class="form-group{{ $errors->has('serie_description') ? ' invalid' : '' }}">
            <label for="task" class=" col-form-label mb-0 pb-0">Beschreibung der Serie</label>
            <label for="task" class=" col-form-label mt-0 pt-0">
				<small class="text-muted"> Hier kannst Du beschreiben, welche Inhalte in der Serie enthalten sind.</small>
			</label>
			<div class="border">
				<textarea id="serie_description" rows="3" class="form-control" name="serie_description" >{{$serie->serie_description}}</textarea>
         	@if ($errors->has('serie_description'))
            <span class="help-block">
               <strong>{{ $errors->first('serie_description') }}</strong>
            </span>
				@endif
			</div>
		</div>
		
		<div class="form-group{{ $errors->has('status') ? ' invalid' : '' }}">
         <label for="status" class=" col-form-label mb-0 pb-0">Status der Serie</label>
			<select class="custom-select" name="status_id" id="status_id">
				<option value="{{$serie->status_id}}">{{$serie->status->status_name}}</option>
				@foreach ($statuses as $status)
					<option value="{{$status->id}}">{{$status->status_name}}</option> 
				@endforeach
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
<h4>Lerneinheiten zur Serie {{$serie->serie_title}}</h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name der Lerneinheiten</th>
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
