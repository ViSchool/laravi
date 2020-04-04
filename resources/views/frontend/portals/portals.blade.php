@extends ('/layout')

@section('stylesheets')
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
@endsection

@section ('page-header')
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">Portalnavigator</h2>
	{{-- <div class="m-4 px-4 d-block d-md-none">
		<button id="btnSidebarCollapse" class="btn btn-light" type="button">
			<i id="btnFilterIcon" class="fas fa-filter"></i>
		</button>
	</div> --}}
</div>
</section>
@endsection
		
@section ('content')
<div class="d-flex w-100">

	{{-- Hauptteil --}}
	<div class="portals container my-3">
		{{-- Filter oben --}}
	<p class="mx-4 p-0 mb-0">Lernportale filtern:</p>
	<form action="/portalnavigator/filter" method="post">
		@csrf
		<div id="filter_buttons" class="mx-3 d-flex justify-content-start"> 
			<a class="btn btn-secondary  m-2" data-toggle="collapse" href="#filter_subjects" role="button" aria-expanded="false" aria-controls="collapseExample">Fächer</a>	
			<a class="btn btn-secondary  m-2" data-toggle="collapse" href="#filter_types" role="button" aria-expanded="false" aria-controls="collapseExample">Lerninhalte</a>
			<a class="btn btn-secondary  m-2" data-toggle="collapse" href="#filter_price" role="button" aria-expanded="false" aria-controls="collapseExample">Preismodell</a>
			<button id="filter_button" class="ml-auto btn-sm btn-primary m-2 d-none" type="submit">Filter anwenden</button>
		</div>
		
		<div class="collapse" id="filter_subjects">
			<div class="card card-body">
				<div class="btn-group-toggle" data-toggle="buttons">
					@foreach ($subjects as $subject)  
						<label class="btn btn-light m-2">
							<input class="filter" value="{{$subject->id}}" name="subjects[]" type="checkbox"> {{$subject->subject_title}}					
						</label>
					@endforeach
				</div> 
			</div>
		</div>
		<div class="collapse" id="filter_types">
			<div class="card card-body">
				<div class="btn-group-toggle" data-toggle="buttons">
					@foreach ($types as $type)  
						<label class="btn btn-light m-2">
							<input class="filter" value="{{$type->id}}" name="types[]" type="checkbox"> {{$type->content_type}}
						</label>
					@endforeach
				</div> 
			</div>
		</div>
		<div class="collapse" id="filter_price">
			<div class="card card-body">
				<div class="btn-group-toggle" data-toggle="buttons">
					@foreach ($prices as $price)  
						<label class="btn btn-light m-2">
							<input class="filter" value="{{$price}}" name="prices[]" type="checkbox"> {{$price}}					
						</label>
					@endforeach
				</div> 
			</div>
		</div>
	</form>

	<hr>

		<div class="container my-5">
			@if (count($portals) > 0)
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
					@foreach ($portals as $portal)  
						<div class="col mb-4">
							<div class="card h-100">
								<div class="card-header p-0 m-0">
									<p class=" text-center card-text"><small>{{$portal->price_model}}</small></p>
								</div>
								<div class=" d-flex justify-content-center bg-white" style="height:120px">
									<img src="/images/portals/{{$portal->portal_img}}" class="img-fluid mt-2" style="max-height: 100px" alt="...">
								</div>
								<div class="card-body text-center">
									<a href="{{$portal->portal_url}}" target="_blank"><h5 class="card-title text-brand-blue">{{$portal->portal_title}}</h5></a>
									<p class="card-text"><small>{{$portal->portal_description}}</small></p>
								</div>
								<div class="d-flex justify-content-between card-footer">
									{{-- Display Types --}}
									<div class="" id="types_part_{{$portal->id}}">
										@php
											$i = 0; 
										@endphp
										@foreach ($portal->types as $type)	
												<span class="badge badge-pill badge-warning"><small>{{$type->content_type}}</small></span>
												@if (++$i > 2)
													<button class="btn btn-link text-warning m-0 p-0" onclick="display_types({{$portal->id}})">...</button>
													@break	 
												@endif
										@endforeach
									</div>
									<div class="d-none" id="types_all_{{$portal->id}}">
										@foreach ($portal->types as $type)	
												<span class="badge badge-pill badge-warning"><small>{{$type->content_type}}</small></span>
										@endforeach
										<button class="btn btn-link m-0 p-0" onclick="hide_types({{$portal->id}})"><small>Schließen</small>  </button>
									</div>

									{{-- Display Subjects --}}
									<div class="" id="subjects_part_{{$portal->id}}">
										@php
											$i = 0; 
										@endphp
										@foreach ($portal->subjects as $subject)	
												<span class="badge badge-pill badge-primary"><small>{{$subject->subject_title}}</small></span>
												@if (++$i > 2)
													<button class="btn btn-link m-0 p-0" onclick="display_subjects({{$portal->id}})">...</button>
													@break	 
												@endif
										@endforeach
									</div>
									<div class="d-none" id="subjects_all_{{$portal->id}}">
										@foreach ($portal->subjects as $subject)	
												<span class="badge badge-pill badge-primary"><small>{{$subject->subject_title}}</small></span>
										@endforeach
										<button class="btn btn-link m-0 p-0" onclick="hide_subjects({{$portal->id}})"><small>Schließen</small>  </button>
									</div>

								</div>
							</div>
						</div>
					@endforeach  
				</div>	 
			@endif
		</div>
	</div>
</div>

@endsection
		

@section('scripts')


{{-- <script>
	$(document).ready(function () {

		$('#btnSidebarCollapse').on('click', function () {
			$('#filter_sidebar').toggleClass('active');
			$('#btnFilterIcon').toggleClass('fa-filter');
			$('#btnFilterIcon').toggleClass('fa-times');
		});

	});	
</script> --}}

<script>
$(document).ready(function () {
	$('.filter').on('change', function () {
		if(this.checked) {
			$('#filter_button').removeClass ('d-none');
		} 
	}); 
});
</script>

<script src="/js/hide_more_on_portals.js">


@endsection