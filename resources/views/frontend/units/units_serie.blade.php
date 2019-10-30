@extends('/layout')

@section ('page-header')
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">Lerneinheiten aus der Serie "{{$serie->serie_title}}"</h2>
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
						<div class="card-footer flex-column align-items-center justify-content-center">
							<small class="text-muted">Aktualisiert: {{$unit->updated_at->diffForHumans()}}</small>
							@if (Auth::check())
								<a class="btn btn-primary w-100" href="/lehrer/{{Auth::user()->id}}/copy/{{$unit->id}}" title="Lerneinheit in meinen Account kopieren"><i class="far fa-copy"></i><small> Lerneinheit kopieren </small> </a>
							@endif
						</div>
  					
  					</div>
  					</div>
  					@endforeach	
  			 
			</div>
	</div>
</section>
@endsection
		

	