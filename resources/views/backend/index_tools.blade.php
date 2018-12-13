@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Tools administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Tools</th>
					<th>Bild zum Tool</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tools as $tool)
				<tr>
					<td><a href="/backend/tools/{{$tool->id}}">{{$tool->tool_title}}</a></td>	
					
					<td>@isset($tool->tool_img_thumb)
					<img class="image-fluid" src="/images/tools/{{$tool->tool_img_thumb}}"></image>
					@endisset
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$tools->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/tools/create">Neues Tool eintragen</a>
</div>
@endsection
