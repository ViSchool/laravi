@extends ('/layout')

@section ('page-header')
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">{{$subject->subject_title}}</h2>
</div>
</section>
@endsection
		
@section ('content')
<section id="subject-topics">
	<div class="container">
		<div class="row">
			@foreach ($subject->topics as $topic)
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
    						<h5 class="text-white mt-5">{{$topic->topic_title}}</h5>
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
		

	