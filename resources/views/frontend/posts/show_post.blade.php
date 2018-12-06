@extends ('layout')
		
@section ('page-header')
<section id="page-header1">
	<div class="p-3 bg-light">
		<div class="container">
			<h3 class="mt-4 text-dark text-uppercase">ViSchool Blog</h3>
		</div>
	</div>
</section>
@endsection

@section('content')
<div class="container">
@isset($post->post_img)
<img class="img-fluid my-5" src="/images/posts/{{$post->post_img}}"></img>
@endisset
	@foreach ($post->tags as $tag)<a href="{{route('blog.index',[$post->id])}}"><small class="badge badge-light my-4">{{$tag->tag_name}}</small></a>@endforeach
<h3 class="text-uppercase">{{$post->post_title}}</h3>
<p class="post_body">{!!$post->post_body!!}</p>
<hr></hr>
</div>

</div>

@endsection
