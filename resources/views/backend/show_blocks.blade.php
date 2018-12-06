@extends ('backend.layout_backend')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <div class="container">
          <h4>Lerneinheit:<a href="/backend/units/{{$unit->id}}"> {{$unit->unit_title}}</a></h4>
          <h5>Aufgabe: {{$block->title}}</h5>
          </div>
          <hr></hr>

<div class="container">
@include('layouts.errors')

	<form method="POST" action="{{route('backend.blocks.update',[$block->id])}}" enctype="multipart/form-data">
		{{ csrf_field() }} {{ method_field('PATCH') }}
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text">Überschrift für die Aufgabe:</label>
			</div>
			<input value="{{$block->title}}" type="text" class="form-control" id="title" name="title">
		</div>
		<!-- <div class="form-group mb-3">
			<label class="mb-0">Aufgabentext:</label>
			<textarea class="form-control task-summernote" id="task" name="task" aria-label="task" aria-describedby="task"></textarea>
		</div> -->
		<input type="hidden" name="unit_id" value="{{$unit->id}}">
				
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="time">Zeit für die Aufgabe:</label>
			</div>
			<input value="{{$block->time}}" type="text" class="form-control" size="2" maxlength="2" id="time" name="time"></input>
			<div class="input-group-append">
				<span class="input-group-text">Minuten</span>
			</div>
		</div>
		<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="differentiation">Bestimmte Schülergruppe:</label>
		</div>
		<select class="form-control" id="differentiation" name="differentiation">
			<option value="{{$block->differentiation->id}}">{{$block->differentiation->differentiation_title}}</option>
			@foreach($differentiations as $differentiation)
				<option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
			@endforeach

		</select>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="alternative">Alternative zu dieser Aufgabe:</label>
		</div>
		<select class="form-control" id="alternative" name="alternative">
			@if($block->alternative != NULL)
			<option value="{{$blockAlternative->id}}">{{$blockAlternative->title}} ({{$blockAlternative->differentiation->differentiation_title}})</option>
			@else 
			<option value="keine">Bitte auswählen</option>
			@endif
			<option value="keine">(noch) keine</option>
			@foreach($unit->blocks as $block)
				<option value="{{$block->id}}">{{$block->title}} ({{$block->differentiation->differentiation_title}})</option>
			@endforeach
		</select>
	</div>
		
		<button class="btn btn-primary form-control" type="submit">Änderungen in dieser Aufgabe speichern</button>
</form>	
<hr></hr>

<div>
	<h4>Vorschau für diese Aufgabe</h4>
	@php 
		$firstblock_order = $unit->blocks->min('order');
		$ordernumber = 0;
	@endphp
	
	<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-4">
						@php $ordernumber ++; @endphp
						<div class="col-10">
							Aufgabe {{$ordernumber}} von {{$unit->blocks->count()}}
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-9">	
							<h5 id="title_{{$block->id}}" style="font-family: Cabin Sketch" class="pt-4 pb-1 m-0">{{$block->title}}:</h5>
						</div>
						<div class="col-3">
							<i class="pt-4 far fa-clock"></i>
							<span id="time_{{$block->id}}"> {{$block->time}}</span> Minuten
						</div>
					</div>
				</div>
					
				<!-- CardBody -->					
				<div class="card-body">
						<div class="row">
							<div class="col-10 d-flex align-items-start flex-column mb-3">
								<div class="mb-auto">
									@if (isset ($block->task))
										{!! str_limit($block->task,100, ' (...)');!!}
									@endif
								</div>
							</div>
							<div class="col-12 d-flex align-items-start flex-column mb-3">
								<div class="mb-auto">
									@isset ($block->content_id)
										@php $content = App\Content::findOrFail($block->content_id);@endphp
										@isset ($content->content_img_thumb)
											<a href="/content/{{$content->id}}" target="_blank"><img src="/images/contents/{{$content->content_img}}" alt="Bild:{{$content->content_title}}"></img></a>
										@endisset 
										@empty ($content->content_img_thumb) 
											@switch($content->tool_id)
												@case(1)
													<a href="/content/{{$content->id}}" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/{{$content->toolspecific_id}}/mqdefault.jpg"></img></a>
												@break
												@case(7)
													<a href="/content/{{$content->id}}" target="_blank"><img class="img-fluid p-2" src="{{$content->img_thumb_url}}"></img></a>
												@break
												@default
													@isset ($content->portal->portal_img)
														<a href="/content/{{$content->id}}" target="_blank"><img src="/images/portals/{{$content->portal->portal_img}}"></img></a>
													@endisset
													@empty ($content->portal->portal_img)
														<a href="/content/{{$content->id}}"><p><i class="{{$content->type->type_icon}} fa-3x"> </i></p><p> {{$content->type->content_type}} "{{$content->content_title}}" öffnen </p></a>
													@endempty
												@break
											@endswitch
										@endempty		
									@endisset
									@empty($block->content_id)
										@empty($block->task)
											<div class="container">
												<p>Hier fehlt ein Inhalt oder eine Aufgabe!</p>
											</div>
										@endempty
									@endempty
								</div>
							</div>
							<div class="col">
								<div class="mt-auto">
									<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i></button>
								</div>
							</div>
						</div>
					</div>
					


				<div class="card-footer text-right">
					<a href="/backend/blocks/create2/{{$block->id}}" class="card-link">Aufgabentext oder Digitalen Inhalt bearbeiten</a>
				</div>	
			</div>
</div>

	
	<div class="pt-5 form-group">
		<form method="POST" action="{{route('backend.blocks.destroy',[$block->id])}}">
			{{ csrf_field() }} {{ method_field('DELETE') }}
			<button class=" form-control btn btn-warning" type="submit"> Aufgabe komplett löschen</button>
		</form>
	</div>
</div>

@include('layouts.errors')
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	var markupStr = '{!!$block->task!!}';
	$('.task-summernote').summernote({
        height: 130,
        toolbar: [],
        focus: true
      });
	
	$('.task-summernote').summernote('code', markupStr);
	});
	
</script>
<script>
      $('.task-summernote').summernote({
        height: 130,
        toolbar: [],
        focus: true
      });
</script>

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
@endsection