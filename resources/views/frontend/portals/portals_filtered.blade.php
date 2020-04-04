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
	<p class="mx-4 p-0 mb-0">Deine Filter:</p>
		
	<div id="filtered" class=" d-flex container"> 
		@if ($filter_subjects == 1)
			@foreach ($subjects as $subject)
				@php
					$remove = $subject->id;
					$othersubjects = $subjects->filter(function($value,$key) use($remove) {
						return $value['id'] != $remove;
					});
				@endphp
				<form action="/portalnavigator/filter" method="post">
					@csrf
					@foreach ($othersubjects as $othersubject)
					 	<input type="hidden" name="subjects[]" value="{{$othersubject->id}}">
					@endforeach
					@if($filter_types == 1)
					@foreach ($types as $type)
					 	<input type="hidden" name="types[]" value="{{$type->id}}">
					@endforeach
					@endif
					<button type="submit" class="btn-sm btn-outline-primary mr-2">
  						<span aria-hidden="true">&times; {{$subject->subject_title}}</span>
					</button>
				</form>
			@endforeach
		@endif
		@if ($filter_types == 1)
			@foreach ($types as $type)
				@php
					$remove = $type->id;
					$othertypes = $types->filter(function($value,$key) use($remove) {
						return $value['id'] != $remove;
					});
				@endphp
				<form action="/portalnavigator/filter" method="post">
					@csrf
					@foreach ($othertypes as $othertype)
					 	<input type="hidden" name="types[]" value="{{$othertype->id}}">
					@endforeach
					@if($filter_subjects == 1)
						@foreach ($subjects as $subject)
					 		<input type="hidden" name="subjects[]" value="{{$subject->id}}">
						@endforeach
					@endif
					<button type="submit" class="btn-sm btn-outline-warning mr-2">
  						<span aria-hidden="true">&times; {{$type->content_type}}</span>
					</button>
				</form>
			@endforeach
		@endif
		@if ($filter_prices == 1)
			@foreach ($prices as $price)
				@php
					$otherprices = $prices;
					if (($key = array_search($price, $otherprices)) !== false) {
    					unset($otherprices[$key]);
					}
				@endphp
				<form action="/portalnavigator/filter" method="post">
					@csrf
					@foreach ($otherprices as $otherprice)
					 	<input type="hidden" name="prices[]" value="{{$otherprice}}">
					@endforeach
					@if($filter_types == 1)
						@foreach ($types as $type)
					 		<input type="hidden" name="types[]" value="{{$type->id}}">
						@endforeach
					@endif
					@if($filter_subjects == 1)
						@foreach ($subjects as $subject)
					 		<input type="hidden" name="subjects[]" value="{{$subject->id}}">
						@endforeach
					@endif
					<button type="submit" class="btn-sm btn-outline-secondary mr-2">
  						<span aria-hidden="true">&times; {{$price}}</span>
					</button>
				</form>
			@endforeach
		@endif
		<a href="/portalnavigator" class="ml-auto btn-sm btn-primary mx-2">Alles zurücksetzen</a>
	</div>
			

	

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
													<button class="btn btn-link m-0 p-0 text-warning" onclick="display_types({{$portal->id}})">...</button>
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

<script src="/js/hide_more_on_portals.js">


@endsection