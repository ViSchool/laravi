@extends('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">{{$topic->topic_title}}</h2>
</div>
</section>
@endsection
		
@section ('content')
<section id="topic_units">
	<div class="container my-4">
				<div class="row justify-content-start">
					@foreach ($units as $unit)
					<div class="col">
					<div class="card m-3" style="width:200px">
						@isset ($unit->content_img_thumb)
						<a href="/content/{{$content->id}}"><img class="card-img-top" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
						@endisset
						@empty ($content->content_img_thumb) 
							@switch($content->tool_id)
								@case(1)
								<a href="/content/{{$content->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
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
							@php $rating = 1.3; @endphp  

            @foreach(range(1,5) as $i)
                <span class="fa-stack" style="width:1em">
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
		

	