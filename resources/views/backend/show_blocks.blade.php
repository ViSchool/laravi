@extends ('backend.layout_backend')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('main')
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		@include('layouts.errors')		
		<div class="card m-3">
			<div class="card-header bg-warning">
				<h5>Aufgabe "{{$block->title}}" bearbeiten</h5>
			</div>	 
			<form class="my-3" method="POST" action="{{route('backend.blocks.update',[$block->id])}}" enctype="multipart/form-data">
				{{ csrf_field() }} {{ method_field('PATCH') }}
				
				<input type="hidden" name="unit_id" value="{{$block->unit_id}}">

				<div class="form-group">
					<label for="title" class="col-md-6 control-label">Überschrift für die Aufgabe:</label>
					<div class="col-lg-10">
						<input id="title" type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title" value="{{$block->title}}" required autofocus>
						@if ($errors->has('title'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('title') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="task" class="col-md-6 control-label">Aufgabentext:</label>
					<div class="col-lg-10">
					<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task" autofocus>{!!$block->task!!}</textarea>
						@if ($errors->has('task'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('task') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="content_id" class="col-md-6 control-label">Digitalen Inhalt aus der Datenbank auswählen:</label>
					<div class="col-lg-10">
					<select id="content_id" name="content_id" class="form-control" autofocus>
						@if (isset($content->id))
							<option value="{{$content->id}}">{{$content->content_title}}</option>
						@else 
							<option value="">Bitte auswählen</option>
						@endif
						@foreach($allContents as $allContent)
							<option value="{{$allContent->id}}">{{$allContent->type->content_type}}: {{$allContent->content_title}}</option>
						@endforeach
						<option value="diftopic">Inhalt aus einem anderen Fach auswählen</option>
					</select>
					</div>
				</div>

				<div class="form-group">
					<div id="choosetopic" class="d-none">
						<label class="col-md-6 control-label" for="topi_id_dif">Inhalte aus anderen Fächern</label>
						<div class="col-lg-10">
						<select id="topic_id_dif" name="topic_id_dif" class="form-control mb-3" autofocus>
							<option value="">Bitte anderes Thema auswählen</option>
							@foreach ($topics as $topic)
								<option value="{{$topic->id}}">{{$topic->topic_title}}</option>
							@endforeach
						</select>
						<select id="content_id_dif" name="content_id_dif" class="form-control" autofocus>
							<option value="">Zuerst Thema auswählen</option>
						</select>
						</div>
					</div>
				</div>

				<div class="col-lg-10">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text"for="time">Zeit für die Aufgabe:</label>
						</div>
						<input class="form-control" type="text" maxlength="2" id="time" name="time" value="{{$block->time}}">
						<div class="input-group-append">
							<span class="input-group-text">Minuten</span>
						</div>
						@if ($errors->has('time'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('time') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="task" class="col-md-6 control-label">Tipp (optional):</label>
					<div class="col-lg-10">
					<textarea class="form-control mb-3" rows="3" id="tipp" name="tipp" aria-label="tipp" aria-describedby="tipp" autofocus>{!!$block->tips!!}</textarea>
						@if ($errors->has('tipp'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('tipp') }}</strong>
							</span>
						@endif
					</div>
				</div>

            <div class="form-group{{ $errors->has('differentiation_id') ? ' has-error' : '' }}">
               <label for="differentiation_id" class="col-lg-10 control-label">Differenzierung von Lernniveaus</label>
               <label for="differentiation_id" class="col-lg-10 col-form-label mt-0 pt-0">
                  <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"{{$unit->differentiation_group}}"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
					</label>
					<div class="col-lg-10 input-group">
						<div class="input-group-prepend">
    						<label class="input-group-text" for="differentiation_id">Lernniveau:</label>
  						</div>
						<select class="custom-select" id="differentiation_id" name="differentiation_id">
							@if($differentiation->id !== 13)
								<option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
								<option value="13">Keine Differenzierung für diese Aufgabe</option>
							@else 
								<option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
								@foreach($otherDifferentiations as $otherDifferentiation)
                           <option value="{{$otherDifferentiation->id}}">{{$otherDifferentiation->differentiation_title}}</option>
                        @endforeach
							@endif
						</select>
					</div>
				</div>
				
				<div class="col-lg-10">
					<button class="btn btn-primary form-control" type="submit">Änderungen in dieser Aufgabe speichern</button>
				</div>
			</form>	
		</div>
		<hr>

<div>
	<h4>Vorschau für diese Aufgabe</h4>
	
	{{-- Calculate position of blocks irrespective of differentited blocks --}}
	@php
		$numberOfBlocks= $unit->blocks->unique('order');
		$ordernumber = 0;
		foreach ($numberOfBlocks as $currentBlock) {
			if	($currentBlock->order !== $block->order) {
				$ordernumber++;
			} else {
				$ordernumber++;
			break;
			}
		}
	@endphp
	
	<div class="card my-1" style="border-color:#03c4eb">
		<!-- CardHeader -->
		<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
			<div class="row mb-4">
				<div class="col-lg-10">
					Aufgabe {{$ordernumber}} von {{count($numberOfBlocks)}}
				</div>
					</div>
					<div class="row mb-2">
						<div class="col-9">	
							<p id="title_{{$block->id}}" class="pt-4 pb-1 m-0">{{$block->title}}:</p>
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
	$('.task-summernote').summernote({
		toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		]
	});
	});
</script>

<script>
$(document).ready(function() {
$('#content_id').change(function() {
 if ($(this).val() == 'diftopic') {
     var topic = document.getElementById('choosetopic');
     topic.classList.add('d-block');
     topic.classList.remove('d-none');
  }
});
});
</script>

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
<script src="{{asset('js/ddd_topic_content.js')}}"></script>
@endsection