@extends ('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Du hast gesucht nach: "{{$query}}"</h2>
</div>
</section>
@endsection
		
@section ('content')
@if($topicsCount == 0)
	<div class="container pt-5">Es gibt keine Themen zu Deinem Suchbegriff.</div>
@endif
@if ($topicsCount > 0)
<section id="search_result_topics">
	<div class="container pt-3">
		<p> Wir haben <a href="/suche/topics/{{$query}}">{{$topicsCount}} Themen</a> gefunden:</p>
		
		<div class="topics">
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				@foreach ($topics3 as $topic)
					<div class="card m-4 text-white" style="width:150px" >
						@if ($topic->updated_at->diffInDays() < 10)
							<span class="badge-danger notify-badge">Neu</span>
						@endif
						<a href="/topic/{{$topic->id}}">
							<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
						</a>
						<div class="card-img-overlay">
							<a href="/topic/{{$topic->id}}">
								<div class="card-text d-flex align-content-between justify-content-center">
									<h5 class="text-white text-center">{{$topic->topic_title}}</h5>
									<p class="content-badge badge-primary"> {{$topic->content()->count()}} Inhalte</p>	
								</div>
							</a>	
						</div>
					</div>
				@endforeach	
			</div>
		</div>

		@if ($topicsCount > 3)
			<div class="col">
				<a class="btn-primary" href="http://">Zeige alle Themen</a>
			</div>
		@endif
	</div>
</section>	
@endif

<section id="search_result_contents">
	@if($contentsCount == 0)
		<div class="container pt-3">Es gibt keine Inhalte zu Deinem Suchbegriff.</div>
	@endif
	@if($contentsCount > 0)
	<div class="container my-4">
		<p> Wir haben <a href="/suche/contents/{{$query}}">{{$contentsCount}} Inhalte</a> gefunden:</p>
		<div class="row justify-content-start">
			@foreach ($contents3 as $content)
			<div class="col">
				<div class="card m-3" style="width:200px">
					@isset ($content->content_img_thumb)
						<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
					@endisset
					@empty ($content->content_img_thumb) 
						@switch($content->tool_id)
							@case(1)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
							@break
							@case(7)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="{{$content->img_thumb_url}}"></img></a>
							@break
							@default
								@isset ($content->portal->portal_img)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/portals/{{$content->portal->portal_img}}"></img></a>
								@endisset
						@endswitch
					@endempty	
					<div class="card-body">
						<a href="/content/{{$content->id}}"><h4 class="card-title">{{$content->content_title}}</h4></a>
						<p class="card-text">
							@php 
							$reviews = App\Review::where('content_id',$content->id)->get();
							$average_score = $reviews->avg('overall_score');
							@endphp
							<!-- Sternchenbewertung auf Inhalte-Card -->
							@if ($average_score > 0)
								@php $rating = $average_score @endphp  
								@foreach(range(1,5) as $i)
									<span class="fa-stack" style="width:1em" data-toggle="tooltip" data-placement="top" title="Durchschnittliche Bewertung">
										<i class="far fa-star fa-stack-1x"></i>
										@if($rating >0)
											@if($rating >0.5)
												<i class="fas fa-star fa-stack-1x"></i>
											@else
												<i class="fas fa-star-half fa-stack-1x"></i>
											@endif
										@endif
										@php $rating--; @endphp
									</span>
								@endforeach
							@endif
						</p>
					</div>
					<div class="card-footer">
      					<small class="text-muted"><i class="{{$content->type->type_icon}} fa-2x"></i> {{$content->type->content_type}}</small>
    				</div>
  				</div>
  			</div>
			@endforeach	
		</div>
	</div>
	@endif
</section>



<section id="search_results_units">
@if($unitsCount == 0)
	<div class="container py-3">Es gibt keine Lerneinheiten zu Deinem Suchbegriff.</div>
@endif
@if($unitsCount > 0)
	<div class="container my-4">
		<p> Wir haben <a href="/suche/units/{{$query}}">{{$unitsCount}} Lerneinheiten</a> gefunden:</p>
		<div class="row justify-content-start">
			@foreach ($units3 as $unit)
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
@endif
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

	