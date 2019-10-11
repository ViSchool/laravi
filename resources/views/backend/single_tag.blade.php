@extends ('backend.layout_backend')

@section('main')


<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
	<div class="card mb-4" style="max-width: 400px">
		<div class="card-header bg-warning">
			<h5>Tag "{{$tag->tag_name}}" bearbeiten</h5>
		</div>
  		<div class="card-body">
			
		  <form method="POST" action="/backend/tags/{{$tag->id}}">
				@csrf @method('PATCH')
					<div class="form-group">
						<label for="tag_name">Tag:</label>
						<input type="text" class="form-control" id="tag_name" name="tag_name" value="{{$tag->tag_name}}">
					</div>
					<div class="form-group">
						<label for="tag-group">Tag-Gruppe:</label>
						<select class="form-control mb-4" id="tag_group" name="tag_group">
							<option>{{$tag->tag_group}}</option>
							@foreach ($taggroups as $taggroup )
								<option>{{$taggroup}}</option>
							@endforeach
								<option value="new">Neue Taggruppe</option>
					</select>
					<div id="new_tag_group_container" class="d-none">
						<label  for="new_tag-group">Name der neuen Tag-Gruppe:</label>
						<input type="text" class="form-control" id="new_tag_group" name="new_tag_group">
					</div>	
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Änderungen speichern</button>
				</div>
	@include('layouts.errors')
			</form>
  		</div>
	</div>	
	
	
	<h4> Inhalte mit dem Tag: "{{$tag->tag_name}}" <small>({{count($tag->contents)}} Inhalte)</small></h4>
	<div class="container">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Titel des Inhalts</th>
					<th>Fach</th>
					<th>Thema</th>
					<th>Typ</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach ($tag->contents as $content)
				<tr>
				<td><a href="/backend/contents/{{$content->id}}">{{$content->content_title}}</a></td>
				<td> {{$content->subject->subject_title}}</td>
				<td> {{$content->topic->topic_title}}</td>
				<td> {{$content->type->content_type}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</main>

@endsection

@section('scripts')
	
<script>
$(document).ready(function() {
$('#tag_group').change(function() {
 if ($(this).val() == 'new') {
     new_tag_group_container.classList.remove('d-none');
  }
});
});
</script>


@endsection
