@extends ('backend.layout_backend')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Aufgabe für die Unterrichtseinheit <a href="/backend/units/{{$unit->id}}">"{{$unit->unit_title}}"</a> anlegen</h2>
          <hr></hr>

<div class="container">
	@include('layouts.errors')

<form method="POST" action="/backend/units/{{$unit->id}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Überschrift für die Aufgabe</label>
		</div>
		<input class="form-control" type="text" id="titleInput" name="title"/>
	</div>
	
	<div class="form-group">
		<label class="mb-0">Aufgabentext:</label>
		<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task"></textarea>
		<input type="hidden" name="unit_id" value="{{$unit->id}}">
	</div>
	
	<div class="input-group mb-3">
		<div class="input-group-prepend">
	<label class="input-group-text"for="time">Zeit für die Aufgabe</label>
		</div>
		<input class="form-control" type="text" maxlength="2" id="time" name="time"></input>
		<div class="input-group-append">
			<span class="input-group-text">Minuten</span>
		</div>
	</div>
	<button class="btn btn-primary form-control" type="submit">Neue Aufgabe speichern</button>
</form>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	$('.task-summernote').summernote({
		toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		]
	});
	});
</script>
<script>
      $('.specialcontent-summernote').summernote({
        height: 130,
        toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		],
      });
</script>

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
@endsection