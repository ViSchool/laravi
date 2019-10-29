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

<section id="topics">
	<div class="container my-4">
		<h3>Lerninhalte für die Suche:{{$query}}</h3>
		
		<div class="topics">
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				@foreach ($topics as $topic)
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

	