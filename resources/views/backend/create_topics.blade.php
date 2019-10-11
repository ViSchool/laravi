@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Neues Thema anlegen</h1>

<div class="container">	
	<form method="POST" action="/backend/topics" enctype="multipart/form-data">
		@csrf
		
		<input type="hidden" name="admin_id" value="{{$admin->id}}">
		<div class="form-group">
			<label for="topic_title">Name des Themas:</label>
			<input type="text" class="form-control" id="topic_title" name="topic_title">
		</div>
		
		<div class="form-group">
		<label>Fach/Fächer auswählen:</label>
			<div class="card">
				<div style="column-count: 3">
					@foreach ($subjects as $subject)	
						<div class="form-check mx-2">
							<input type="checkbox" class="form-check-input" id="{{$subject->id}}" value="{{$subject->id}}" name="subjects[]">
							<label class="form-check-label" for="">{{$subject->subject_title}}</label>
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<small class="form-text text-muted">Neue Tags mit einem "@" beginnen</small>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tags:</span>
			</div>	
			<select class="custom-select select2-multi" name="tags[]" id="tags" multiple="multiple">
				<option value=""></option>
				@foreach ($tags as $tag)
					<option value="{{$tag->id}}">{{$tag->tag_name}}</option>
				@endforeach
			</select>
		</div>
			
		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Thema eintragen</button>
		</div>
	</form>
</div>
@endsection
@section('scripts')

<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $(".select2-multi").select2({
    	tags: true,
    	createTag: function (params) {
    		// Don't offset to create a tag if there is no @ symbol
			if (params.term.indexOf('@') === -1) {
      		// Return null to disable tag creation
      		return null;
    		}
    		return {
      		id: params.term,
      		text: params.term
    		}
  		}
    });
});
</script>

@endsection