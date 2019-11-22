@extends ('/layout')

@section ('page-header')
<!-- delete where not necessary -->
<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Lerneinheit: {{$unit->unit_title}}</h4>
	</div>
</section>
@endsection
		
@section ('content')
<section id="vischool-unit">
	<div class="container my-5">
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
							<small>Für diese Einheit brauchst Du insgesamt: 
							@php 
							$unit_duration = $unit->blocks->sum('time');
							@endphp
							{{$unit_duration}} Minuten</small>
						</div>
					</div>
				</div>
			</div>
			@php 
				$firstblock_order = $unit->blocks->min('order');
				$ordernumber = 0;
			@endphp
			
			<!-- Aufgaben -->			
			@foreach ($unit->blocks->sortBy('order') as $block)
			<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-2">
						@php $ordernumber ++; @endphp
						<div class="col-8">
							<small>Aufgabe {{$ordernumber}} von {{$unit->blocks->count()}}</small>
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
							
					<!-- Differenzierung1 -->
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
								<div class="mb-auto">	
									@if($block->differentiation > 1)<span class="badge badge-pill bg-info">block1_differenzierung_name1</span>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-8 d-flex align-items-start flex-column">
								<div class="mb-auto">
									@if (isset ($block->task1))
										{!!$block->task1!!}
									@endif

									@isset ($block->content_id1)
										@php $content1 = App\Content::findOrFail($block->content_id1);@endphp
										@isset ($content1->content_img_thumb)
											<a href="/content/{{$content1->id}}" target="_blank"><img src="/images/contents/{{$content1->content_img}}" alt="Bild:{{$content1->content_title}}"></img></a>
										@endisset 
										@empty ($content1->content_img_thumb) 
											@switch($content1->tool_id)
												@case(1)
													<a href="/content/{{$content1->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content1->toolspecific_id}}/mqdefault.jpg"></img></a>
												@break
												@case(7)
													<a href="/content/{{$content1->id}}" target="_blank"><img class="img-fluid p-2" src="{{$content1->img_thumb_url}}"></img></a>
												@break
												@default
													@isset ($content1->portal->portal_img)
														<a href="/content/{{$content1->id}}" target="_blank"><img src="/images/portals/{{$content1->portal->portal_img}}"></img></a>
													@endisset
													@empty ($content1->portal->portal_img)
														<a href="/content/{{$content1->id}}"><i class="{{$content1->type->type_icon}} fa-3x"> </i> {{$content1->type->content_type}} öffnen</a>
													@endempty
												@break
											@endswitch
										@endempty		
									@endisset
									@empty($block->content_id1)
										@empty($block->task1)
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
					
					<!-- Differenzierung2 -->
				@if($block->differentiation > 1)
					<hr></hr>
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
								<div class="mb-auto">
									<span class="badge badge-pill bg-info">block1_differenzierung_name2</span>
								</div>
				 			</div>
			 			</div>	
						<div class="row">
							<div class="col d-flex align-items-start flex-column">
								<div class="mb-auto">
									@if (isset ($block->content_id2))
										@php $content2 = App\Content::find($block->content_id2); @endphp
										@isset ($content2->content_img_thumb)
											<a href="/content/{{$content2->id}}" target="_blank"><img src="/images/contents/{{$content2->content_img}}" alt="Bild:{{$content2->content_title}}"></img></a>
										@endisset
										@empty ($content2->content_img_thumb) 
											@switch($content2->tool_id)
												@case(1)
													<a href="/content/{{$content2->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content2->toolspecific_id}}/mqdefault.jpg"></img></a>
												@break
												@case(7)
													<a href="/content/{{$content2->id}}" target="_blank"><img class="img-fluid p-2" src="{{$content2->img_thumb_url}}"></img></a>
												@break
												@default
													@isset ($content2->portal->portal_img)
														<a href="/content/{{$content2->id}}" target="_blank"><img src="/images/portals/{{$content2->portal->portal_img}}"></img></a>
													@endisset
												@break
											@endswitch
										@endempty		
									@elseif (isset ($block->task2))
										<div class="container">
											{!!$block->task2!!}
										</div>
									@else
										<div class="container">
											<p>Hier fehlt ein Inhalt!</p>
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="mt-auto">
		 					<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i></button>
						</div>
					</div>
				@endif
					


				<!-- Differenzierung3 -->
				@if($block->differentiation > 2)
					<hr></hr>
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-start flex-column">
								<div class="mt-auto">
									@if (isset ($block->content_id3))
										@php $content3 = App\Content::find($block->content_id3); @endphp
										@isset ($content3->content_img_thumb)
											<a href="/content/{{$content3->id}}" target="_blank"><img src="/images/contents/{{$content3->content_img}}" alt="Bild:{{$content3->content_title}}"></img></a>
										@endisset
										@empty ($content3->content_img_thumb) 
											@switch($content3->tool_id)
												@case(1)
													<a href="/content/{{$content3->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content2->toolspecific_id}}/mqdefault.jpg"></img></a>
												@break
												@case(7)
													<a href="/content/{{$content2->id}}" target="_blank"><img class="img-fluid p-2" src="{{$content2->img_thumb_url}}"></img></a>
												@break
												@default
													@isset ($content3->portal->portal_img)
														<a href="/content/{{$content3->id}}" target="_blank"><img src="/images/portals/{{$content3->portal->portal_img}}"></img></a>
													@endisset
												@break
											@endswitch
										@endempty		
									@elseif (isset ($block->task3))
										<div class="container">
													{!!$block->task3!!}
										</div>
									@else
										<div class="container">
											<p>Hier fehlt ein Inhalt!</p>
										</div>
									@endif
								</div>
							</div>
						<div class="col d-flex align-items-end flex-column">
								<span class="badge badge-pill bg-info">block1_differenzierung_name3</span>
								<div class="mt-auto">
									<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="was anderes"><i class="fas fa-question-circle" style="color:orange"></i>	</button>
		 						</div>
		 				</div>
					</div>
				@endif
			</div> <!-- close accordion collapse div -->
		</div> <!-- close card div -->
	@endforeach
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
    content: '{!!$block->tips!!}',
  })
})
</script>

@endsection
