@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Blogbeiträge - Übersicht</h1>

<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Titel</th>
					<th>Autor</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post)
				<tr>
					<td>{{$post->id}}</td>
					<td><a href="/backend/blog/{{$post->id}}">{{$post->post_title}}</a></td>	
					<td>{{$post->admin->name}}</i></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$posts->links()}}
		
		<hr></hr>
	<a class="btn btn-primary my-3"href="/backend/blog/create">Neuen Beitrag schreiben</a>
</div>
@endsection
