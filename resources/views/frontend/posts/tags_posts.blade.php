@extends ('layout')
		
@section ('page-header')
<section id="page-header">
	<div class="container">
		<span class="align-middle p-3">
			<h3 class="mt-4">Beiträge zum Tag: {{$tag->tag_name}}</h3>
		</span>
	</div>
</section>
@endsection

@section('content')
<div class="container">
@foreach($tag->posts as $post)
@isset($post->post_img)
<img class="img-fluid my-5" src="/images/posts/{{$post->post_img}}"></img>
@endisset
	@foreach($post->tags as $tag)<small class="badge badge-light my-4">{{$tag->tag_name}}</small>@endforeach
@endforeach
@foreach($tag->posts as $post)
<h3 class="text-uppercase">{{$post->post_title}}</h3>
<p>{!!$post->post_body!!}</p>
<hr></hr>
@endforeach
</div>

</div>

@endsection
