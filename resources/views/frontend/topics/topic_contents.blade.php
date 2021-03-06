@extends ('/layout')

@section('stylesheets')
	<link href="/css/rotating-card.css" rel="stylesheet" />
@endsection

@section ('page-header')
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">{{$topic->topic_title}}</h2>
</div>
</section>
@endsection



		
@section ('content')
	
		@if (\Session::has('success'))
			<div class="alert alert-success">
				<p>{!! \Session::get('success') !!}</p>
			</div>
		@endif

		{{-- <div class="container-fluid">
			{!!$breadcrumbs->render()!!}
		</div> --}}

		<section id="privateUnits">
			<div class="container m-4">
				@if (count($privateUnits) !== 0 || count($privateSeries)!== 0)
				<h4 class="mt-3">Private Lerneinheiten zum Thema "{{$topic->topic_title}}"</h4>
				<div class="row justify-content-start">

					@if(count($privateSeries)!==0)
					@foreach ($privateSeries as $privateSerie)
					@php
						$privateSerieUnits = App\Unit::where('serie_id',$privateSerie->id)->get();
					@endphp
						<div class="col">
							<div class="card-container-flip manual-flip">
								<div class="card-flip">
									<div class="front-flip">
										<div class="cover-flip">
											<img src="/images/topic_back.jpeg"/>
										</div>
										<div class="user-flip">
											@foreach ($privateSerieUnits as $privateSerieUnit)
												@if ($privateSerieUnit->unit_img_thumb !== NULL)
													<img class="rounded" src="/images/units/{{$privateSerieUnit->unit_img_thumb}}"/> 
													@break
												@endif 
											@endforeach 
											<img class="rounded" src="/images/logo_cool.jpg"/>
										</div>
										<div class="content-flip">
											<div class="main-flip">
												<a href="/lerneinheiten/serie/{{$privateSerieUnit->serie_id}}"><h3 class="name-flip">{{$privateSerie->serie_title}}</h3></a>	
												<p class="small text-center">Status: {{$privateSerie->status->status_name}} </p>
											</div>
											<div class="footer-flip">
												<p class="small">{{$privateSerie->units_count}} Lerneinheiten</p>
												<button class="btn btn-simple" onclick="rotateCard(this)">
														<i class="fa fa-mail-forward"></i> Mehr erfahren
												</button>
											</div>								
										</div>															
									</div> <!--end front panel -->
									<div class="back-flip">
										<div class="header-flip">
											<h5 class="mb-1">Beschreibung:</h5>
											<p class="small">{{$privateSerie->serie_description}}</p>
										</div>
										<div class="content-flip">
											<div class="main-flip">
												<h5 class="mx-3">Diese Lerneinheiten gehören zur Serie:</h5>
												<ul class="list-group">
													@foreach ($privateSerieUnits as $privateSerieUnit)
														<li class="list-group-item py-0 px-2 mx-2 border-0 list-group-item-action"><a class="small" href="/lerneinheit/{{$privateSerieUnit->id}}">{{$privateSerieUnit->unit_title}}</a></li>
													@endforeach 
												</ul>
												<div class="d-flex justify-content-center">
													<a class="btn-sm btn-primary mx-4 mt-2" href="/lerneinheiten/serie/{{$privateSerieUnit->serie_id}}"> ...alle Lerneinheiten</a>
												</div>
											</div>
										</div>
										<div class="footer-flip">
											<button class="btn btn-simple" rel="tooltip" title="umdrehen" onclick="rotateCard(this)">
												<i class="fa fa-reply"></i> Zurück
											</button>
										</div>	 
									</div>
								</div>
							</div>
						</div>
					@endforeach
					@endif

					@if(count($privateUnits)!==0)
					@foreach ($privateUnits as $privateUnit)
						<div class="col">
							<div class="card m-3" style="width:200px">	
								<div class="card-header bg-success">
									<a href="/lerneinheit/{{$privateUnit->id}}"><h4 class="text-white card-title">{{$privateUnit->unit_title}}</h4></a>
									<p class="card-text">			
										@php 
											$reviews_privateUnit = App\Review::where('unit_id',$privateUnit->id)->get();
											$average_score_privateUnit = $reviews_privateUnit->avg('overall_score');
										@endphp
										@if ($average_score_privateUnit > 0)
											@include('components.rating_stars',['average_score' => $average_score_privateUnit])
										@endif
									</p>
								</div>
								<div class="card-body">
									<p>
										<h4>Darum geht's:</h4>
										{{$privateUnit->unit_description}}
									</p>
								</div>
								<div class="card-footer">
									<span><i class="{{$privateUnit->status->status_icon}}"></i></span>
									<p class="text-muted"> <small>Zuletzt aktualisiert: {{$privateUnit->prettyDate($privateUnit->updated_at)}}</small> </p>
								</div>
							</div>
						</div>
					@endforeach	
					@endif	 	
				</div>
				<hr>
				@endif
			</div>
		</section>

		<section id="topic_contents">	
			<div class="container m-4">
				@if (count($privateContents) !== 0) 
				<h4 class="mt-3">Private Inhalte zum Thema "{{$topic->topic_title}}"</h4>
				<div class="row justify-content-start">	
					@foreach ($privateContents as $privateContent)
					<div class="col">
						<div class="card m-3" style="width:200px">
							@isset ($privateContent->content_img_thumb)
								<a href="/content/{{$privateContent->id}}"><img class="card-img-top" src="/images/contents/{{$privateContent->content_img}}" alt="Bild:{{$privateContent->content_title}}"></img></a>
							@endisset
							@empty ($privateContent->content_img_thumb) 
								@switch($privateContent->tool_id)
									@case(1)
										<a href="/content/{{$privateContent->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$privateContent->toolspecific_id}}/mqdefault.jpg"></img></a>
									@break
									@case(7)
										<a href="/content/{{$privateContent->id}}"><img class="card-img-top" src="{{$privateContent->img_thumb_url}}"></img></a>
									@break
									@default
										@isset ($privateContent->portal->portal_img)
										<a href="/content/{{$privateContent->id}}"><img class="card-img-top" src="/images/portals/{{$privateContent->portal->portal_img}}"></img></a>
										@endisset
								@endswitch
							@endempty	
							<div class="card-body">
								<a href="/content/{{$privateContent->id}}"><h4 class="card-title">{{$privateContent->content_title}}</h4></a>
								<p class="card-text">
									@php 
										$reviews_privateContent = App\Review::where('content_id',$privateContent->id)->get();
										$average_score_privateContent = $reviews_privateContent->avg('overall_score');
									@endphp
									<!-- Sternchenbewertung auf Inhalte-Card -->
									@if ($average_score_privateContent > 0)
										@include('components.rating_stars',['average_score' => $average_score_privateContent])
									@endif
								</p>
							</div>
								
							<div class="card-footer">
								<small class="text-muted"><i class="{{$privateContent->type->type_icon}} fa-2x"></i> {{$privateContent->type->content_type}}</small>
							</div>
							
						</div>
					</div>
					@endforeach	
				</div>
				@endif
			</div>
		</section>


		<section id="topic_units">
			<div class="container m-4">
				@if (count($publicUnits) !== 0 || count($publicSeries) !== 0) 
				<h4 class="mt-3">Komplette Lerneinheiten zum Thema "{{$topic->topic_title}}"</h4>
				<div class="row justify-content-start">
					
					@foreach ($publicSeries as $publicSerie)
					@php
						$publicSerieUnits = App\Unit::where('serie_id',$publicSerie->id)->limit(2)->get();
						$publicSerieTopic = $publicSerieUnits->first()->topic_id;
					@endphp
						<div class="col">
							<div class="card-container-flip manual-flip">
								<div class="card-flip">
									<div class="front-flip">
										<div class="cover-flip">
											<img src="/images/topic_back.jpeg"/>
										</div>
										<div class="user-flip">
											@foreach ($publicSerieUnits as $publicSerieUnit)
												@if ($publicSerieUnit->unit_img_thumb !== NULL)
													<img class="rounded" src="/images/units/{{$publicSerieUnit->unit_img_thumb}}"/> 
													@break
												@endif 
											@endforeach 
											<img class="rounded" src="/images/logo_cool.jpg"/>
										</div>
										<div class="content-flip">
											<div class="main-flip">
												<a href="/lerneinheiten/serie/{{$publicSerieUnit->serie_id}}"><h3 class="name-flip">{{$publicSerie->serie_title}}</h3></a>	
											</div>
											<div class="footer-flip">
												<p class="small">{{$publicSerie->units_count}} Lerneinheiten</p>
												<button class="btn btn-simple" onclick="rotateCard(this)">
														<i class="fa fa-mail-forward"></i> Mehr erfahren
												</button>
											</div>								
										</div>															
									</div> <!--end front panel -->
									<div class="back-flip">
										<div class="header-flip bg-warning">
											<h5 class="mb-1">Beschreibung:</h5>
											<p class="small">{{$publicSerie->serie_description}}</p>
										</div>
										<div class="content-flip">
											<div class="main-flip">
												<h5 class="m-3">Diese Lerneinheiten gehören zur Serie:</h5>
												<ul class="list-group">
												@foreach ($publicSerieUnits as $publicSerieUnit)
													<li class="list-group-item py-0 px-2 border-0 list-group-item-action"><a class="small" href="/lerneinheit/{{$publicSerieUnit->id}}">{{$publicSerieUnit->unit_title}}</a></li> 
													
												@endforeach
													
													<a class=" text-center btn-sm btn-primary mx-4 mt-2" href="/lerneinheiten/serie/{{$publicSerieUnit->serie_id}}"> ...alle Lerneinheiten</a>
												
												</ul>	
											</div>
										</div>
										<div class="footer-flip">
											<button class="btn btn-simple" rel="tooltip" title="umdrehen" onclick="rotateCard(this)">
											<i class="fa fa-reply"></i> Zurück
											</button>
										</div>	 
									</div>
								</div>
							</div>
						</div>
					@endforeach

					
					@foreach ($publicUnits as $publicUnit)
						<div class="col">
							<div class="card m-3" style="width:200px">	
								<div class="card-header bg-warning">
									<a href="/lerneinheit/{{$publicUnit->id}}"><h4 class="card-title">{{$publicUnit->unit_title}}</h4></a>
									<p class="card-text">
										@php 
											$reviews_publicUnit = App\Review::where('unit_id',$publicUnit->id)->get();
											$average_score_publicUnit = $reviews_publicUnit->avg('overall_score');
										@endphp			
										@if ($average_score_publicUnit > 0)
											@include('components.rating_stars',['average_score' => $average_score_publicUnit])
										@endif
									</p>
								</div>
								<div class="card-body">
									<p>
										<h4>Darum geht's:</h4>
										{{$publicUnit->unit_description}}
									</p>
								</div>
								<div class="card-footer flex-column align-items-center justify-content-center">
									<small class="text-muted">Aktualisiert: {{$publicUnit->updated_at->diffForHumans()}}</small>
									@if (Auth::check())
										<a class="btn btn-primary w-100" href="/lehrer/{{Auth::user()->id}}/copy/{{$publicUnit->id}}" title="Lerneinheit in meinen Account kopieren"><i class="far fa-copy"></i><small> Lerneinheit kopieren</small> </a>
									@endif
								</div>
								
							</div>
						</div>
					@endforeach		 	
				</div>
				<hr>
				@endif
			</div>
		</section>

		<section id="topic_contents">	
			<div class="container m-4">
				<h4 class="mt-3">Einzelne Inhalte zum Thema "{{$topic->topic_title}}"</h4>
				<div class="row justify-content-start">	
					@foreach ($publicContents as $publicContent)
					<div class="col">
						<div class="card m-3" style="width:200px">
							@isset ($publicContent->content_img_thumb)
								<a href="/content/{{$publicContent->id}}"><img class="card-img-top" src="/images/contents/{{$publicContent->content_img}}" alt="Bild:{{$publicContent->content_title}}"></img></a>
							@endisset
							@empty ($publicContent->content_img_thumb) 
								@switch($publicContent->tool_id)
									@case(1)
										<a href="/content/{{$publicContent->id}}"><img class="card-img-top" src="https://img.youtube.com/vi/{{$publicContent->toolspecific_id}}/mqdefault.jpg"></img></a>
									@break
									@case(7)
										<a href="/content/{{$publicContent->id}}"><img class="card-img-top" src="{{$publicContent->img_thumb_url}}"></img></a>
									@break
									@default
										@isset ($publicContent->portal->portal_img)
										<a href="/content/{{$publicContent->id}}"><img class="card-img-top" src="/images/portals/{{$publicContent->portal->portal_img}}"></img></a>
										@endisset
								@endswitch
							@endempty	
							<div class="card-body">
								<a href="/content/{{$publicContent->id}}"><h4 class="card-title">{{$publicContent->content_title}}</h4></a>
								<p class="card-text">
									@php 
										$reviews_publicContent = App\Review::where('content_id',$publicContent->id)->get();
										$average_score_publicContent = $reviews_publicContent->avg('overall_score');
									@endphp
									<!-- Sternchenbewertung auf Inhalte-Card -->
									@if ($average_score_publicContent > 0)
										@include('components.rating_stars',['average_score' => $average_score_publicContent])
									@endif
								</p>
							</div>
								
							<div class="card-footer">
								<small class="text-muted"><i class="{{$publicContent->type->type_icon}} fa-2x"></i> {{$publicContent->type->content_type}}</small>
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
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

        $('a.scroll-down').click(function(e){
            e.preventDefault();
            scroll_target = $(this).data('href');
             $('html, body').animate({
                 scrollTop: $(scroll_target).offset().top - 60
             }, 1000);
        });

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container-flip');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

<script>
$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#filter_sidebar').toggleClass('active');
    });

});
</script>

@endsection		

	