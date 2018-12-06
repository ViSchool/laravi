@extends ('backend.layout_backend')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Aufgabe für die Unterrichtseinheit <a href="/backend/units/{{$unit->id}}">"{{$unit->unit_title}}"</a> anlegen</h2>
          <h5>Schritt 1 von 4 - Überschrift für die Aufgabe</h5>
          <hr></hr>

<div class="container">
	@include('layouts.errors')

<form method="POST" action="/backend/blocks" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Überschrift für die Aufgabe:</label>
		</div>
		<input class="form-control" type="text" id="titleInput" name="title"/>
		<input type="hidden" name="unit_id" value="{{$unit->id}}">
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
	<label class="input-group-text"for="time">Zeit für die Aufgabe:</label>
		</div>
		<input class="form-control" type="text" maxlength="2" id="time" name="time"></input>
		<div class="input-group-append">
			<span class="input-group-text">Minuten</span>
		</div>
		<small class="text-muted">Bitte hier zunächst eine ungefähre Zeit festlegen. Nach der Auswahl der Inhalte wird die Zeit automatisch überprüft.</small>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="differentiation">Bestimmte Schülergruppe:</label>
		</div>
		<select class="form-control" id="diffenrentiation" name="differentiation">
			<option value="">Bitte wählen</option>
			@foreach($differentiations as $differentiation)
				<option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
			@endforeach
		</select>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="alternative">Alternative zu dieser Aufgabe:</label>
		</div>
		<select class="form-control" id="alternative" name="alternative">
			<option value="keine">Bitte wählen</option>
			<option value="keine">(noch) keine</option>
			@foreach($unit->blocks as $block)
				<option value="{{$block->id}}">{{$block->title}} ({{$block->differentiation->differentiation_title}})</option>
			@endforeach
		</select>
	</div>
	<hr></hr>
	<button class="btn btn-primary form-control" type="submit">Weiter zu Schritt 2:  Inhalte für diese Aufgabe festlegen</button>
</form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	$('.task-summernote').summernote({
		toolbar: [],
	});
	});
</script>
@endsection