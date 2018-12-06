@extends ('backend.layout_backend')

@section('main')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h4> Inhalte mit dem Tag: "{{$tag->tag_name}}" <small>({{count($tag->contents)}} Inhalte)</small></h4>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Inhalts</th>
					<th>Fach</th>
					<th>Thema</th>
					<th>Typ</th>
					<th>Tags</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tag->contents as $content)
				<td><a href="/backend/contents/{{$content->id}}">{{$content->content_title}}</a></td>
				<td> {{$content->subject->subject_title}}</td>
				<td> {{$content->topic->topic_title}}</td>
				<td> {{$content->content_type}}</td>
				<td>	@foreach ($content->tags as $tag)
						<span class="badge badge-secondary">{{$tag->tag_name}}</span>
						@endforeach
				</td>
				@endforeach
			</tbody>
		</table>
	</div>
</main>

@endsection