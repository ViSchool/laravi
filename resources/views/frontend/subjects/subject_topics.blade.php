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

	<div class="topics">
		<div class="container">
			@if (count($privateTopics) > 0)
				<div class="row mt-5 ml-3">
					<h3>Private Themen</h3>
				</div>
				<div class="d-flex flex-wrap align-content-center justify-content-center">
					@foreach ($privateTopics as $privateTopic)
						<div class="card m-4 text-white" style="width:150px" >
							@if ($privateTopic->updated_at->diffInDays() < 10)
							<span class=" badge-danger notify-badge">Neu</span>
							@endif
							<a href="/topic/{{$privateTopic->id}}">
								<img class="card-img rounded img-thumbnail bg-success" src="/images/topic_back.jpeg" alt="Card image">
							</a>
							<div class="card-img-overlay">
								<a href="/topic/{{$privateTopic->id}}">
									<div class="card-text d-flex align-content-between justify-content-center">
										<h5 class="text-white text-center">{{$privateTopic->topic_title}}</h5>
										<p class="content-badge badge-info">{{$privateTopic->content->count()}} Inhalte</p>	
									</div>
								</a>	
							</div>
						</div>
					@endforeach
				</div>
				<hr>
				<div class="row mt-3 ml-3">
					<h3>Öffentliche Themen</h3>
				</div>
			@endif
				
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				@foreach ($publicTopics as $topic)
					@if($topic->content->count()>0)
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
											
										<p class="content-badge badge-primary"> {{$topic->content->where('status_id',1)->count()}} Inhalte</p>	
									</div>
								</a>	
							</div>
						</div>
					@endif
				@endforeach	
			</div>

		</div>
	</div>
</div>

@endsection
		

@section('scripts')


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