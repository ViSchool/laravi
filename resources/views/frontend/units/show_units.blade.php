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
							$unit_duration = $unit->blocks->sum('time');
							@endphp
							{{$unit_duration}} Minuten</p>
						</div>
					</div>
				</div>
			</div>
			@if ($differentiationExists == 1)
			<div class="card my-1">
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<p>Diese Unterrichtseinheit enthält unterschiedliche Aufgaben für verschiedene Lernniveaus. Wähle Dir hier Dein Lernniveau aus, damit Du nur Deine Aufgaben siehst. Wenn Du nicht sicher bist, welches Lernniveau Du auswählen sollst, frage bitte Deinen Lehrer</p>
						</div>
						<div class="col-2">
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bitte wählen</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									@foreach($differentiations as $differentiation_id)
									@php
									$listDiff = App\Differentiation::findOrFail($differentiation_id);
									@endphp
									<a class="dropdown-item" href="{{route('units.filterdiffs' , ['unit' => $unit->id , 'diff' => $listDiff->id])}}">{{$listDiff->differentiation_title}}</a>
									<option value="{{$listDiff->id}}"></option>
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
											@isset ($content->content_img_thumb)
													<img class="card-img" src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}">
											@endisset 
											@empty ($content->content_img_thumb) 
												@switch($content->tool_id)
													@case(1)
														<img class="p-4 card-img" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg">
													@break
													@case(7)
														<img class="p-2 card-img" src="{{$content->img_thumb_url}}">
													@break
													@default
														@isset ($content->portal->portal_img)
															<img src="/images/portals/{{$content->portal->portal_img}}" class="card-img">
														@endisset
													@break
												@endswitch
											@endempty
											<div class="card-img-overlay d-flex justify-content-center align-items-center">
												<span class="fa-stack fa-2x card-text">
													<i class="fas fa-square fa-stack-2x"></i>
													<i class="far fa-play-circle fa-inverse fa-stack-1x"></i>
												</span>
											</div>
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
					
					<!-- Differenzierung2 -->
				
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
