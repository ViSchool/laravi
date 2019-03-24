@extends ('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">{{$topic->topic_title}}</h2>
</div>
</section>
@endsection
		
@section ('content')
<section id="topic_units">
</section>

<section id="topic_contents">
	<div class="container my-4">
		@if (count($topic->unit) !== 0) 
		<h4>Komplette Lerneinheiten zum Thema "{{$topic->topic_title}}"</h4>
		<div class="row justify-content-start">
			@foreach ($units as $unit)
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-header bg-warning">
							<a href="/lerneinheit/{{$unit->id}}"><h4 class="card-title">{{$unit->unit_title}}</h4></a>
							<p class="card-text">			
								@include('components.rating_stars',['$average_score' => $average_score])
							</p>
						</div>
						<div class="card-body">
							<p>
								<h4>Darum geht's:</h4>
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
		@endif
		<hr>

		<h4>Einzelne Inhalte zum Thema "{{$topic->topic_title}}"</h4>
		<div class="row justify-content-start">	
			@foreach ($contents as $content)
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
						@include('components.rating_stars',['$average_score' => $average_score])
            	@endif
			</p>
	</div>
						
							
						<div class="card-footer">
      						<small class="text-muted"><i class="{{$content->type->type_icon}} fa-2x"></i> {{$content->type->content_type}}</small>
    					</div>
  					
  					</div>
  					</div>
  					@endforeach	
  			<div class="container row">	
			<ul class="pagination">{{$contents->links()}}</ul>
			</div>
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

	