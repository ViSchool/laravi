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
		<div class="row justify-content-start">
			@foreach ($topics as $topic)
				<div class="col">
					<div class="item">
					<div class="card m-4 text-white" style="width:150px" >
  						@if ($topic->updated_at->diffInDays() < 10)
  						<span class=" badge-danger notify-badge">Neu</span>
  						@endif
  						<a href="/topic/{{$topic->id}}">
  							<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
  						</a>
  						<div class="card-img-overlay">
    						<div class="card-text">
    						<span class="align-middle  text-center">
    						<a href="/topic/{{$topic->id}}">
    						<p class="text-white mt-5">{{$topic->topic_title}}</p>
    						</a>
    						</span>
    						<a href="/topic/{{$topic->id}}">
    							<span class="ml-5 p-2 content-badge badge-info">{{$topic->content()->count()}} Inhalte</span>
    						</a>
    						</div>
  						</div>
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

	