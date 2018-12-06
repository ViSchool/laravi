@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Neues Thema anlegen</h1>

<div class="container">	
<form method="POST" action="/backend/topics" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		<label for="topic_title">Name des Themas:</label>
		<input type="text" class="form-control" id="topic_title" name="topic_title">
			
		<label for="subject_id">Fach/Fächer auswählen:</label>
		<select class="form-control" id="subjects"" name="subjects[]" multiple="multiple">
		<option></option>
		@foreach ($subjects as $subject)	
			<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
		@endforeach
		</select>
		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Thema eintragen</button>
		</div>
</form>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $("#subjects").select2();
});
</script>


@endsection