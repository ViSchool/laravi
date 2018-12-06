@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Thema bearbeiten</h1>

<div class="container">
	<div class="container">	
 	<form method="POST" action="{{route('topics.update',[$topic->id])}}"> 	
	 {{ csrf_field() }} {{ method_field('PATCH') }}
		<div class="form-group">
			<label for="topic_title">Name des Themas:</label>
			<input type="text" class="form-control" id="topic_title" name="topic_title" value="{{$topic->topic_title}}">
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
		<hr></hr>
		<div class="form-group">
			<form method="POST" action="{{route('topics.destroy',[$topic->id])}}">
				{{ csrf_field() }} {{ method_field('DELETE') }}
					<button class="btn btn-warning" type="submit"> Thema komplett löschen</button>
			</form>
		</div>
	
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

