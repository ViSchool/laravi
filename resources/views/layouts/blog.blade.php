<section id="vischool-blog">
<div class="container my-5">
	<div class="row">
		<div class="col text-center">
			<h2>ViSchool-Blog</h2>
			<p>Neuigkeiten und Wissenswertes</p>
		</div>
	</div>
		
		<div class="card-columns mt-5">
			@foreach($posts as $post)
				<div class="card">
		<!-- noch prüfen: wenn es ein bild gibt dann diese Zeile einfügen -->
					@isset($post->post_img)
					<a href="/blog/{{$post->id}}"><img class="card-img-top" src="/images/posts/{{$post->post_img}}" alt="Card image cap"></a>
					@endisset
					<div class="card-body">
						<a href="/blog/{{$post->id}}"><h5 class="card-title">{{$post->post_title}}</h5></a>
						<p class="card-text"><small class="text-muted">{{$post->updated_at->diffForHumans()}}</small></p>
						<p class="card-text">@foreach ($post->tags as $tag)<a href="{{route('blog.tag',[$tag->id])}}"><small class="badge badge-light">{{$tag->tag_name}}</small></a>@endforeach</p>
					</div>
				</div>
			@endforeach
		</div>
</div>
</section>
