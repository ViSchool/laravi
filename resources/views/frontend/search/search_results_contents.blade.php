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

	