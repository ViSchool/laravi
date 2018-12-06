@extends('backend.layout_backend')

@section ('stylesheets')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
  	selector: 'textarea',
  	plugins: 'link',
  	menubar: false,
  });
  </script>
@endsection

@section('main')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
<h1>Blogbeitrag bearbeiten </h1>

<div class="container">	
	<form method="POST" action="{{route('posts.update',[$post->id])}}" enctype="multipart/form-data">
		{{ csrf_field() }} {{ method_field('PATCH') }}
		<div class="form-group">
			<label for="post_title">Titel:</label>
			<input type="text" value="{{$post->post_title}}"class="form-control" id="post_title" name="post_title">
		</div>
		<div class="form-group">
			<label for="post_body">Text:</label>
			<textarea class="form-control" id="post_body" name="post_body">{{$post->post_body}}</textarea>
		</div>
		
		<div class="form-group">
				<label class="float-left p-2">Aktuelles Bild:</label>
				@isset($post->post_img)
				<img class="img-fluid float-left p-2 img-thumbnail" src="/images/posts/{{$post->post_img}}" style="width:150px"></img>
				@endisset
		</div>
		<div class="form-group">	
			<label class="my-3" for="post_img">Start-Bild für den Beitrag ändern:</label>
			<input type="file" class="form-control" id="post_img" name="post_img">
		</div>
		
		<div class="form-group my-3">
			<label for="tags">Tags:</label>
			<select class="select2-multi form-control" name="tags[]" id="tags" multiple="multiple">
				@foreach ($tags as $tag)
				<option value="{{$tag->id}}">{{$tag->tag_name}}</option>
				@endforeach
			</select>
		</div>	
		
		
		<button type="submit" class=" form-control btn btn-primary">Änderungen speichern</button>
	</form>
</div>
<hr></hr>

<div class=" container form-group">
	<form method="POST" action="{{route('posts.destroy',[$post->id])}}">
		{{ csrf_field() }} {{ method_field('DELETE') }}
		<button class=" form-control btn btn-warning" type="submit"> Blogbeitrag komplett löschen</button>
	</form>
</div>
			
@include('layouts.errors')
@endsection

@section('scripts')
<script>
$(document).ready(function() {
	$('#tags').select2({
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
	$("#tags").select2().val({!!json_encode($post->tags()->allRelatedIds())!!}).trigger('change');
});
</script>
<!-- Select2 initialisieren -->
@endsection

