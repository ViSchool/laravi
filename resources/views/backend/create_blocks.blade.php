@extends ('backend.layout_backend')

@section('stylesheets')
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-lg-10 pt-3">
          <h2></h2>
          <hr>

<div class="container">
	@include('layouts.errors')

	<div class="card m-3">
		<div class="card-header bg-warning">
			<h5>Aufgabe für die Unterrichtseinheit "{{$unit->unit_title}}" anlegen</h5>
		</div>
		<div>
			<form class="my-3" method="POST" action="/backend/blocks" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="title" class="col-md-6 col-form-label">Überschrift für die Aufgabe:</label>
					<div class="col-lg-10">
						<input id="title" type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" name="title" value="{{old('title')}}" required autofocus>
						@if ($errors->has('title'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('title') }}</strong>
							</span>
						@endif
					</div>
				</div>

			
				<div class="form-group">
					<label for="task" class="col-md-6 col-form-label">Aufgabentext:</label>
					<div class="col-lg-10">
						<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task" autofocus>{{old('task')}}</textarea>
						<input type="hidden" name="unit_id" value="{{$unit->id}}">
						@if ($errors->has('task'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('task') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="content_id" class="col-md-6 col-form-label">Digitalen Inhalt aus der Datenbank auswählen:</label>
					<div class="col-lg-10">
					<select id="content_id" name="content_id" class="form-control" autofocus>
						<option value="">Bitte auswählen</option>
						@foreach($contents as $content)
							<option value="{{$content->id}}">{{$content->type->content_type}}: {{$content->content_title}}</option>
						@endforeach
						<option value="diftopic">Inhalt aus einem anderen Fach auswählen</option>
					</select>
					</div>
				</div>


				<div class="form-group">
					<div id="choosetopic" class="d-none">
						<label class="col-md-6 col-form-label" for="topi_id_dif">Inhalte aus anderen Fächern</label>
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
						<input class="form-control" type="text" maxlength="2" id="time" name="time" value="{{old('time')}}">
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
					<label for="task" class="col-md-6 col-form-label">Tipp (optional):</label>
					<div class="col-lg-10">
						<textarea class="form-control mb-3" rows="3" id="tipp" name="tipp" aria-label="tipp" aria-describedby="tipp" autofocus>{{old('tipp')}}</textarea>
						@if ($errors->has('tipp'))
							<span class="help-block">
								<strong class="text-danger">{{ $errors->first('tipp') }}</strong>
							</span>
						@endif
					</div>
				</div>

				@if($unit->differentiation_group !== Null)
               <div class="form-group{{ $errors->has('differentiation_id') ? ' invalid' : '' }}">
                  <label for="differentiation_id" class="col-10 col-form-label">Differenzierung von Lernniveaus</label>
                  <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                     <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"{{$unit->differentiation_group}}"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
                  </label>
                  <div class="col-10">
                     <select class="form-control" id="differentiation_id" name="differentiation_id">
				            @if((old('differentiation_id')) !== null)
                        	@php 
                              $differentiation_id_old = old('differentiation_id');
                              $differentiation_old = App\Differentiation::where('id', '=' , $differentiation_id_old)->first();
                           @endphp
                           <option value="{{$differentiation_id_old}}">{{$differentiation_old->differentiation_title}}</option>
				            @endif
		                  @empty(old('differentiation_id'))
                           <option value="">Bitte auswählen</option>
                        @endempty
                           @foreach($differentiations as $differentiation)
                              <option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
                           @endforeach
                        <option value="13">Alle</option>
                     </select>
                     @if ($errors->has('differentiation_id'))
                        <span class="help-block">
                           <strong>{{ $errors->first('differentiation_id') }}</strong>
                        </span>
                     @endif
                  </div>
               </div>
            @endif


				<div class="col-lg-10">
					<button class="btn btn-primary form-control" type="submit">Neue Aufgabe speichern</button>
				</div>
			</form>
		</div>
	</div>

</div>
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