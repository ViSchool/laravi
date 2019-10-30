@extends ('/layout')

@section ('page-header')
<!-- delete where not necessary -->
<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheit: {{$unit->unit_title}}</h4>
	</div>
</section>
@endsection
		
@section ('content')
<section id="vischool-unit">
	<div class="container my-5">
		@if (\Session::has('success'))
    		<div class="alert alert-success">
            <p>{!! \Session::get('success') !!}</p>
    		</div>
		@endif
		<div id="accordion" role="tablist">
			<!-- Startblock -->
			<div class="card">
				<div class="card-header text-white" role="tab" id="start_block" style="background-color:#03c4eb">
					<div class="row">
						<div class="col">
							<h3 class="pt-2 font-weight-bold" style="color:#ff3333;">Das wirst Du heute machen:</h3>
							<p>{{$unit->unit_description}}</p>
						</div>
					</div>
					@isset($unit->unit_img)
					<div class="row mb-3">
						<div class="col-3">
						</div>
						<div class="col-6">
							<img class="img-fluid img-thumbnail" src="/images/units/{{$unit->unit_img}}"></img>
						</div>
						<div class="col-3">
						</div>
					</div>
					@endisset
					<div class="row">
						<div class="col text-right">
							<p>Für diese Einheit brauchst Du insgesamt: 
							@php
							$uniqueBlocks = $unit->blocks->unique('order');
							$unit_duration = $uniqueBlocks->sum('time') + 2;
							@endphp
							{{$unit_duration}} Minuten</p>
						</div>
					</div>
				</div>
			</div>
			@if ($unit->differentiation_group != NULL)
			<div class="card my-1">
				<div class="card-body">
					<div class="row d-flex justify-content-center">
						<div class=" col-10 col-md-8">
							<p class="text-left">Diese Unterrichtseinheit enthält unterschiedliche Aufgaben für verschiedene Lernniveaus. Wähle Dir hier Dein Lernniveau aus, damit Du nur Deine Aufgaben siehst. Wenn Du nicht sicher bist, welches Lernniveau Du auswählen sollst, frage bitte Deinen Lehrer</p>
						</div>
					</div>
					<div class="row ">
						<div class="col-10 d-flex justify-content-around align-items-center">
						<p class="mt-1 font-weight-bold">Ausgewähltes Lernniveau: </p> 
							<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$startDifferentiation->differentiation_title}}</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									@foreach ($differentiations as $differentiation)
									<a class="dropdown-item" href="{{route('units.filterdiffs' , ['unit' => $unit->id , 'diff' => $differentiation->id])}}">{{$differentiation->differentiation_title}}</a>
									<option value="{{$differentiation->id}}"></option>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
			
			@php 
				$firstblock_order = $unit->blocks->min('order');
				$ordernumber = 0;
			@endphp
			
			<!-- Aufgaben -->			
			@foreach ($blocks as $block)
			<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-2">
						@php $ordernumber ++; @endphp
						<div class="col-8">
							<small>Aufgabe {{$ordernumber}} von {{$unit->blocks->unique('order')->count()}}</small>
						</div>
						<div class="col-3 text-right">
							<i class=" far fa-clock fa-sm"></i>
							<span id="time_{{$block->id}}"> {{$block->time}}</span> Minuten
						</div>
					</div>
					<hr class="m-1"></hr>
					<div class="row my-5">
						<div class="col-9">	
							<h4 id="title_{{$block->id}}" class="pt-2 m-0"> {{$block->title}}</h4>
						</div>
						<div class="col-2">
							<div class="d-flex align-items-end flex-row-reverse flex-column">
								<a class="collapsed" data-toggle="collapse" href="#collapse{{$block->id}}" role="button" aria-expanded="false"aria-controls="collapseTwo" style="color:#ffff00;">
								<i class="fa fa-2x fas fa-plus-circle"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
					
				<!-- CardBody -->
				<div id="collapse{{$block->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
							</div>
						</div>
						<div class="row">
							<div class="col-8 d-flex align-items-start flex-column">
								<div class="mb-auto">
									@if (isset ($block->task))
										{!!$block->task!!}
									@endif

									@isset ($block->content_id)
										@php $content = App\Content::findOrFail($block->content_id);@endphp
										<a href="/content/{{$content->id}}" target="_blank">
										<div class="card border border-primary w-75">
											@isset ($content->content_img)
												<img class="card-img p-2" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}" style="max-height: 100%; width:auto;">
												<div class="card-img-overlay d-flex justify-content-center align-items-center">
													<span class="fa-stack fa-3x card-text">
														<i class="fas fa-square fa-inverse fa-stack-2x"></i>
														<i class="far fa-play-circle  fa-stack-1x"></i>
													</span>
												</div>
											@endisset 
											@empty ($content->content_img) 
												@switch($content->tool_id)
													@case(1)
														<img class="p-4 card-img" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg">
														<div class="card-img-overlay d-flex justify-content-center align-items-center">
															<span class="fa-stack fa-3x card-text">
																<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																<i class="far fa-play-circle  fa-stack-1x"></i>
															</span>
														</div>
													@break
													@case(6)
														<img class="p-2 card-img" src="/images/topic_back.jpeg">
														<div class="card-img-overlay d-flex justify-content-center align-items-center">
															<p class="text-white">{{$content->content_title}}</p>
															<p>
																<span class="fa-stack fa-3x card-text">
																	<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																	<i class="far fa-play-circle  fa-stack-1x"></i>
																</span>
															</p>
														</div>
													@break
													@case(7)
														<img class="p-2 card-img" src="{{$content->img_thumb_url}}">
														<div class="card-img-overlay d-flex justify-content-center align-items-center">
															<span class="fa-stack fa-3x card-text">
																<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																<i class="far fa-play-circle  fa-stack-1x"></i>
															</span>
														</div>
													@break
													@default
														@isset ($content->portal->portal_img)
															<img src="/images/portals/{{$content->portal->portal_img}}" class="card-img p-2">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<span class="fa-stack fa-3x card-text">
																	<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																	<i class="far fa-play-circle  fa-stack-1x"></i>
																</span>
															</div>
														@endisset
														@empty ($content->portal->portal_img)
															<img class="p-2 card-img" src="/images/topic_back.jpeg">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<p class="text-white">{{$content->content_title}}</p>
																<p>
																	<span class="fa-stack fa-3x card-text">
																		<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																		<i class="far fa-play-circle  fa-stack-1x"></i>
																	</span>
																</p>
															</div>
														@endempty
													@break
												@endswitch
											@endempty
										</div>
										</a>		
									@endisset										
									@empty($block->content_id)
										@empty($block->task)
											<div class="container">
												<p>Hier fehlt ein Inhalt!</p>
											</div>
										@endempty
									@endempty
								</div>
							</div>
							<div class="col d-flex flex-row-reverse align-self-start">
								<div class="mt-auto">
									@if ($block->tips !== null)
									<a tabindex="0" class="btn" role="button" data-toggle="popover" data-html="true" title="Lerntipp" data-content=" {{$block->tips}}" data-placement="auto"><i class="fas fa-question-circle fa-lg" style="color:#03c4eb"></i></a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div> <!-- close accordion collapse div -->
			</div> <!-- close card div -->
			@endforeach
			
			<!-- LAST BLOCK Review -->
			<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader Review Unit -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-2">
						<div class="col-8">
							<small>Letzte Aufgabe</small>
						</div>
						<div class="col-3 text-right">
							<i class=" far fa-clock fa-sm"></i>
							<span id="time_review">2</span> Minuten
						</div>
					</div>
					<hr class="m-1"></hr>
					<div class="row my-5">
						<div class="col-9">	
							<h4 id="title_review" class="pt-2 m-0">Bitte bewerte wie Dir diese Lerneinheit gefallen hat.</h4>
						</div>
						<div class="col-2">
							<div class="d-flex align-items-end flex-row-reverse flex-column">
								<a class="collapsed" data-toggle="collapse" href="#collapsereview" role="button" aria-expanded="false"aria-controls="collapseTwo" style="color:#ffff00;">
								<i class="fa fa-2x fas fa-plus-circle"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
					
				<!-- CardBody -->
				<div id="collapsereview" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
							</div>
						</div>
						<div class="row">
							<div class="col-10 d-flex align-items-start flex-column">
								<div class="mb-auto">
									<div class="container">
										<h3>Bewerten</h3>
										<form action="/reviews" method="POST" enctype="multipart/form-data">
											@csrf
											<!-- AHA Review -->
											<div class="row">
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_aha.jpg" alt="AHA!" width="60">
														<div class="pt-2">
															<div class="rating">
																<input id="star1_aha" type="radio" name="aha_score" value="5">
																<label for="star1_aha"></label>
																<input id="star2_aha" type="radio" name="aha_score" value="4">
																<label for="star2_aha"></label>
																<input id="star3_aha" type="radio" name="aha_score" value="3">
																<label for="star3_aha"></label>
																<input id="star4_aha" type="radio" name="aha_score" value="2">
																<label for="star4_aha"></label>
																<input id="star5_aha" type="radio" name="aha_score" value="1">
																<label for="star5_aha"></label>
															</div>
														</div>
													</div>
												</div>	
												
												<!-- COOL Review -->	
												
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_cool.jpg" alt="COOL!" width="60"></img>
														<div class="pt-2">
															<div class="rating">
																<input id="star1_cool" type="radio" name="cool_score" value="5">
																<label for="star1_cool"></label>
																<input id="star2_cool" type="radio" name="cool_score" value="4">
																<label for="star2_cool"></label>
																<input id="star3_cool" type="radio" name="cool_score" value="3">
																<label for="star3_cool"></label>
																<input id="star4_cool" type="radio" name="cool_score" value="2">
																<label for="star4_cool"></label>
																<input id="star5_cool" type="radio" name="cool_score" value="1">
																<label for="star5_cool"></label>
															</div>
														</div>
													</div>
												</div>
													
												<!-- WIRKT Review -->	
												
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_wirkt.jpg" alt="WIRKT!" width="60"></img>
														<div class="pt-2">
															<div class="rating">
																<input id="star1_wirkt" type="radio" name="wirkt_score" value="5">
																<label for="star1_wirkt"></label>
																<input id="star2_wirkt" type="radio" name="wirkt_score" value="4">
																<label for="star2_wirkt"></label>
																<input id="star3_wirkt" type="radio" name="wirkt_score" value="3">
																<label for="star3_wirkt"></label>
																<input id="star4_wirkt" type="radio" name="wirkt_score" value="2">
																<label for="star4_wirkt"></label>
																<input id="star5_wirkt" type="radio" name="wirkt_score" value="1">
																<label for="star5_wirkt"></label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-10">
												<textarea class="form-control" name="review_comment" id="review_comment" rows="3" placeholder="Was hat Dir gefallen oder nicht? Wofür hast Du gelernt?"></textarea>	
												<input type="hidden" name="review_unit_id" value="{{$unit->id}}"/>
												<input type="hidden" name="review_content_id" value="0"/>

												</div>
											</div>	
											<div class="row">
												<div class="">
													<button class="mt-3" type="submit">Bewerten</button>
												</div>
											</div>
										</form>
									</div>

								</div>
							</div>
							<div class="col d-flex flex-row-reverse align-self-start">
								<div class="mt-auto">
									<a tabindex="0" class="btn" role="button" data-toggle="popover" data-html="true" title="Lerntipp" data-content="Die Bewertung hilft uns den Unterricht zu verbessern." data-placement="auto"><i class="fas fa-question-circle fa-lg" style="color:#03c4eb"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- close accordion collapse div -->
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
<script>
      $(function () {
  $('.tipp_popover').popover({
    container: 'body',
    html: 'true',
  })
})
</script>

@endsection
