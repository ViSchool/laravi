@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lernportale administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Portals</th>
					<th>Bild zum Portal</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($portals as $portal)
				<tr>
					<td><a href="/backend/portals/{{$portal->id}}">{{$portal->portal_title}}</a></td>	
					
					<td>@isset($portal->portal_img_thumb)
					<img class="image-fluid" src="/images/portals/{{$portal->portal_img_thumb}}"></image>
					@endisset
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<ul class="pagination">{{$portals->links()}}</ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/portals/create">Neues Portal eintragen</a>
</div>
@endsection
