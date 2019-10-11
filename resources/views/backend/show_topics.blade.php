@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Thema bearbeiten</h1>

<div class="container">
	<div class="container">	
 	<form method="POST" action="{{route('topics.update',[$topic->id])}}"> 	
	 @csrf @method('PATCH')
		
	 	<div class="form-group">
			<label class="text-muted" for="topic_title">Dieses Thema ist erstellt durch:</label>
			<input type="text" class="text-muted form-control" id="topic_user" value="{{$topic->user->user_name}}" readonly>
		</div>
		
	 	<div class="form-group">
			<label for="topic_title">Name des Themas:</label>
			<input type="text" class="form-control" id="topic_title" name="topic_title" value="{{$topic->topic_title}}">
		</div>
		
		<div class="form-group">
		<label>Fach/Fächer auswählen:</label>
			<div class="card">
				<div style="column-count: 3">
					@foreach ($subjects as $subject)	
						<div class="form-check mx-2">
							<input type="checkbox" class="form-check-input" id="{{$subject->id}}" value="{{$subject->id}}" name="subjects[]" @if (in_array($subject->subject_title, $currentSubjects)) checked @endif>
							<label class="form-check-label" for="">{{$subject->subject_title}}</label>
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="subjects">Das Thema gehört zum Fach:</label>
			<select class="form-control" id="subjects" multiple="multiple" name="subjects[]"> 
			@foreach ($subjects as $subject)
			<option value="{{$subject->id}}">{{$subject->subject_title}}</option> 
			@endforeach
			</select>
		</div>
				
		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	</form>
		
	
	@include('layouts.errors')
</div>
<hr></hr>
<div class = "container mt-5">
<h4>Inhalte zum Thema <span class="btn-lg btn-info">{{$topic->topic_title}}</span></h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name des Inhalts</th>
					<th>Art des Inhalts</th>
				</tr>
			</thead>
			<tbody>
				@isset($topic->content)
				@foreach ($topic->content->sortBy('content_title') as $content)
				<tr>
					<td><a href="/backend/contents/{{$content->id}}">{{$content->content_title}}</a></td>	
					<td>{{$content->content_type}}</td>
				</tr>
				@endforeach
				@endisset
			</tbody>
		</table>	
</div>
@endsection
@section('scripts')
	<script>
		$(document).ready(function() {
		$("#subjects").select2();
		$("#subjects").select2().val({!!json_encode($topic->subjects()->allRelatedIds())!!}).trigger('change');
		});
	</script>
@endsection

