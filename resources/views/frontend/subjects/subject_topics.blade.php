@extends ('/layout')

@section('stylesheets')
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
@endsection

@section ('page-header')
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">{{$subject->subject_title}}</h2>
	@if (count($publicTopics) + count($privateTopics) > 200)
	<div class="m-4 px-4 d-block d-md-none">
		<button id="btnSidebarCollapse" class="btn btn-light" type="button">
			<i id="btnFilterIcon" class="fas fa-filter"></i>
		</button>
	</div>
	@endif
</div>
</section>
@endsection
		
@section ('content')
<div class="d-flex w-100">
	@if (count($publicTopics) + count($privateTopics) > 200)
	<nav id="filter_sidebar">
		<ul class="list-unstyled components ">
         <h4 class="mx-5">Themen filtern</h4>
			
			{{-- Taggruppe Klassenstufe --}}
			<li>
				<a href="#klassenstufeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Klassenstufe</a>
            <ul class="collapse list-unstyled" id="klassenstufeSubmenu">
					@foreach ($klassenstufeTags as $klassenstufeTag )
						<li>
							<div class="form-check m-0 p-0">
							<input class="form-check-input" type="checkbox" id="{{$klassenstufeTag->id}}" value="{{$klassenstufeTag->id}}">
  								<label class="form-check-label font-weight-normal ml-4" for="klassenstufe_{{$klassenstufeTag->id}}">
								  {{$klassenstufeTag->tag_name}}
								</label>
							</div>
               	</li>
					@endforeach
            </ul>
			</li>
      </ul>
	</nav>
	@endif

	<section id="subject-topics">
		<div class="container">
				@if (count($privateTopics) > 0)
					<div class="row  mt-5 ml-3">
					<h3>Private Themen</h3>
					</div>
					<div class="row">
					@foreach ($privateTopics as $privateTopic)
					<div class="col">
						<div class="item">
						<div class="card m-4 text-white" style="width:150px" >
							@if ($privateTopic->updated_at->diffInDays() < 10)
							<span class=" badge-danger notify-badge">Neu</span>
							@endif
							<a href="/topic/{{$privateTopic->id}}">
								<img class="card-img rounded img-thumbnail bg-success" src="/images/topic_back.jpeg" alt="Card image">
							</a>
							<div class="card-img-overlay">
								<div class="card-text">
								<span class="align-middle  text-center">
								<a href="/topic/{{$privateTopic->id}}">
								<h5 class="text-white mt-5">{{$privateTopic->topic_title}}</h5>
								</a>
								</span>
								<a href="/topic/{{$privateTopic->id}}">
									<span class="ml-5 p-2 content-badge badge-info">{{$privateTopic->content()->count()}} Inhalte</span>
								</a>
								</div>
							</div>
						</div>
						</div>
					</div>
				@endforeach
				</div>
				<hr>
				<div class="row mt-3 ml-3">
					<h3>Öffentliche Themen</h3>
				</div>
				@endif
				<div class="row">
				@foreach ($publicTopics as $topic)
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
</div>

@endsection
		

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
	$(document).ready(function () {

		$('#btnSidebarCollapse').on('click', function () {
			$('#filter_sidebar').toggleClass('active');
			$('#btnFilterIcon').toggleClass('fa-filter');
			$('#btnFilterIcon').toggleClass('fa-times');
		});

	});	
</script>

@endsection