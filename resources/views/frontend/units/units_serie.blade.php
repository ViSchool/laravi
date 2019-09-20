@extends('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Lerneinheiten aus der Serie "{{$serie->serie_title}}"</h2>
</div>
</section>
@endsection
		
@section ('content')
<section id="serie_units">
	<div class="container my-4">
				<div class="row justify-content-start">
					@foreach ($units as $unit)
					<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/{{$unit->id}}"><h4 class="card-title">{{$unit->unit_title}}</h4></a>
							<p class="card-text">			
							@include('components.rating_stars',['$average_score' => $average_score])
							</p>
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
		

	