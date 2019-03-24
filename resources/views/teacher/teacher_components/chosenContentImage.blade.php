@php $content = App\Content::find($id); @endphp
@isset($content)
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
         @break
		@endswitch
	@endempty	
	<div class="card-body">
		<a href="/content/{{$content->id}}"><h4 class="card-title">{{$content->content_title}}</h4></a>						
	</div>
	<div class="card-footer">
      <small class="text-muted"><i class="{{$content->type->type_icon}} fa-2x"></i> {{$content->type->content_type}}</small>
   </div>					
</div>
@endisset