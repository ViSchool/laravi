<div class="card m-3" style="width:150px">  
	@isset ($content->content_img_thumb)
			<a target="_blank" href="/content/{{$content->id}}"><img class="card-img-top" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
	@endisset
	@empty ($content->content_img_thumb) 
			@switch($content->tool_id)
				@case(1)
					<a target="_blank" href="/content/{{$content->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
				@break
				@case(7)
					<a target="_blank" href="/content/{{$content->id}}"><img class="card-img-top" src="{{$content->img_thumb_url}}"></img></a>
				@break
				@default
					@isset ($content->portal->portal_img)
					    <a target="_blank" href="/content/{{$content->id}}"><img class="card-img-top" src="/images/portals/{{$content->portal->portal_img}}"></img></a>
					@endisset
			@endswitch
	@endempty	
	<div class="card-body">
			<a target="_blank" href="/content/{{$content->id}}"><h5 class="card-title">{{$content->content_title}}</h5></a>
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
    <div class="card-footer d-flex justify-content-between">
            <small class="text-muted">
                <i class="{{$content->type->type_icon}} "></i> {{$content->type->content_type}}
            </small>
    </div>
    <div class="card-footer bg-success text-white d-flex justify-content-between">
        <small>Diesen Inhalt auswählen: </small>
        {{--<input type="hidden" value="{{$content->id}}" id="contentIdInput" name="contentID">
        <a href="/lehrer/unterrichtseinheiten/{{$unit->id}}/aufgabe/{{$content->id}}"><i class="far fa-check-square fa-2x" style="color:green"></i></button> --}}
        <input class="with-font" type="radio" name="chooseContent" id="chooseContent-{{$content->id}}" value="{{$content->id}}">
    </div>
</div>
