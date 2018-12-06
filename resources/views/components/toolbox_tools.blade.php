@section ('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
@endsection


<div class="col-3 p-0 m-0 border d-sm-none d-none d-md-block" id="toolbox">
	<div class="container-fluid">
		<h3 class="mt-2 text-center text-white">Toolbox-Werkzeuge</h3>
		
		<ul class="nav nav-tabs nav-justified" style="font-size:1.125rem;">
    		<li class="nav-item">
				<a class="nav-link active px-0 mx-0" id="nav-lerneinheit-tab" data-toggle="tab" href="#nav-lerneinheit" role="tab" aria-controls="nav-lerneinheit" aria-selected="true">Lerneinheit</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-0 mx-0" id="nav-aufgabe-tab" data-toggle="tab" href="#nav-aufgabe" role="tab" aria-controls="nav-aufgabe" aria-selected="false">Aufgaben</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-0 mx-0" id="nav-inhalt-tab" data-toggle="tab" href="#nav-inhalt" role="tab" aria-controls="nav-inhalt" aria-selected="false">Inhalte</a>
			</li>
		</ul>
			
		<div class="tab-content" id="nav-tabContent">
			<!-- Tab Lerneinheit -->
			<div class="tab-pane fade show active" id="nav-lerneinheit" role="tabpanel" aria-labelledby="nav-lerneinheit-tab">	
				@if (isset($unit->id))
				<form method="POST" action="{{route('unit.edit',[$unit->id])}}" enctype="multipart/form-data">
				{{ csrf_field() }} {{method_field('PATCH')}}
				@else
				<form method="POST" action="{{route('unit.store')}}" enctype="multipart/form-data">
				{{ csrf_field() }} 
				@endif
					<div class="form-group mt-3">
						<label style="color:white; font-size:1.25rem;" for="subject_id">Fach auswählen:</label>
						<select class="form-control form-control-lg" id="subject_id" name="subject_id">
							@if (isset($unit->id))
							<option value="{{$unit->subject_id}}">{{$unit->subject->subject_title}}</option>
							@else
							<option value=""></option>
							@endif
							@foreach ($subjects as $subject)	
							<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
							@endforeach
						</select>
						
						<label style="color:white; font-size:1.25rem;" for="topic_id">Thema auswählen:</label>
						<select class="form-control form-control-lg" id="topic_id" name="topic_id">
							@if (isset($unit->id))
							<option value="{{$unit->topic_id}}">{{$unit->topic->topic_title}}</option>
							@else
							<option>Zuerst Fach auswählen</option>
							@endif
						</select>
						<div class="col-md-2">
							<span id="loader" style="visibility: hidden;">
								<i class="far fa-spinner fa-spin"></i>
							</span>
						</div>

						<label style="color:white; font-size:1.25rem;" for="unit_title">Titel der Unterichtseinheit:</label>
						@if(isset($unit->id))
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title" value="{{$unit->unit_title}}"/>
						@else
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title"/>	
						@endif
						<label style="color:white; font-size:1.25rem;" for="unit_description">Lernziel/Beschreibung der Unterichtseinheit:</label>
						<textarea class="form-control" id="unit_description" name="unit_description" aria-label="unit_description" aria-describedby="unit_description">@if(isset($unit->id)){{$unit->unit_description}}@endif</textarea>
						<button class="badge border-primary bg-primary p-2 my-3" type="submit">Lerneinheit speichern</button>
					
					</div>
				</form>
			</div>
					
			<!-- Tab Aufgaben -->
			<div class="tab-pane fade d-flex " id="nav-aufgabe" role="tabpanel" aria-labelledby="nav-aufgabe-tab">
				<div class="m-3  flex-row justify-content-start">
				</div>
				@if(isset($unit->id))
				<form method="POST" action="{{route('blocks.store')}}" enctype="multipart/form-data">
				{{ csrf_field()}}
					<div class="form-group mt-3">
						<label style="color:white; font-size:1.25rem;" for="subject_id">Titel der Aufgabe:</label>
						@if(isset($block->id))
						<input type="text" class="form-control" id="title" name="title" aria-label="title" aria-describedby="title" value="{{$block->title}}"/>
						@else
						<input type="text" class="form-control" id="title" name="title" aria-label="title" aria-describedby="title"/>	
						@endif
											
						<label for="task" style="color:white; font-size:1.25rem;">Aufgabentext:</label>
						<textarea class="form-control mb-3" rows="8" id="summernote" name="task" aria-label="task" aria-describedby="task">
						@if (isset($block->id)) 
						{{$block->task}}
						@endif
						</textarea>
						
						<div class="form-inline form-group my-2">
							<label style="color:white; font-size:1.25rem;" class="mx-1" for="differentiation">Anzahl unterschiedlicher Lernniveaus:</label>
							<select class="form-control" id="differnetiation" name="differentiation">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</div>
						@if (isset($unit->id)) 
						<input name="unit_id" type="number" hidden value="{{$unit->id}}">
						@endif	
	  					<button class="badge border-primary bg-primary p-2 my-3" type="submit">Aufgabe speichern</button>
					</div>
				</form>
				@endif
			</div>
		
			<!-- Tab Inhalte -->
			<div class="tab-pane fade" id="nav-inhalt" role="tabpanel" aria-labelledby="nav-inhalt-tab">
			</div>
		</div>
	</div>
</div> <!-- close col for toolbox -->

@section('scripts')
<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
        $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
  ]});
});
</script>
@endsection