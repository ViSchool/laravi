@extends ('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Suchergebnis</h2>
</div>
</section>
@endsection
		
@section ('content')
<section id="topic_units">
</section>

<section id="topic_contents">
	<div class="container my-4">
	<h3>Lerninhalte für die Suche:{{$query}}</h3>
		<div class="row justify-content-start">
			@foreach ($units as $unit)
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/{{$unit->id}}"><h4 class="card-title">{{$unit->unit_title}}</h4></a>
							<hr></hr>
							<p><h4>Darum geht's:</h4>
							 {{$unit->unit_description}}
							</p>
						</div>
						<div class="card-footer">
      						<small class="text-muted">Zuletzt aktualisiert: {{$unit->updated_at}}</small>
    					</div>
  					</div>
  				</div>
  			@endforeach		
			</div>
	</div>
</section>
@endsection

@section('scripts')
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>
@endsection		

	