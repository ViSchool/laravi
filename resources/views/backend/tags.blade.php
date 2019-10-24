@extends ('backend.layout_backend')

@section('main')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Tags - Übersicht</h1>

<div class="container">
	<div class="row mb-3">
		<a class="btn btn-primary" data-toggle="collapse" href="#createTag">Neuen Tag anlegen</a>
		<div class="collapse" id="createTag">
			<form method="POST" action="/backend/tags">
				{{ csrf_field() }}
			<div class="card card-body">
				<div class="form-group">
					<label for="tag_name">Tag:</label>
					<input type="text" class="form-control" id="tag_name" name="tag_name">
				</div>
				<div class="form-group">
					<label for="tag-group">Tag-Gruppe:</label>
					<select class="form-control mb-4" id="tag_group" name="tag_group">
						<option value="">ohne</option>
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
					<button type="submit" class="btn btn-primary">Tag eintragen</button>
				</div>
	@include('layouts.errors')
			</div>
			</form>
		</div>

		


	</div>
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Tag (zum Bearbeiten klicken)</th>
					<th>Tag-Gruppe</th>
					<th>Löschen</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tags as $tag)
				<tr>
					<td><a href="/backend/tags/{{$tag->id}}">{{$tag->tag_name}}</a></td>	
					<td>{{$tag->tag_group}}</td>
					<td>
						<form method="POST" action="{{route('tags.destroy',[$tag->id])}}">
							{{ csrf_field() }} {{ method_field('DELETE') }}
							<button class="btn btn-link" type="submit"><i class="far fa-trash-alt"></i></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<hr>
</div>
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
