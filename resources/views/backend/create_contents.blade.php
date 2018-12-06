@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neuen Inhalt anlegen</h2>
          <hr></hr>

<div class="container">
	@include('layouts.errors')
<form method="POST" action="/backend/contents" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Titel des Inhalts:</label>
			</div>
			<input type="text" class="form-control" id="content_title" name="content_title" value="{{old('content_title')}}">
		</div>
			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
				@if((old('subject_id')) !== null)
					@php 
						$subject_id_old = old('subject_id');
						$subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
					@endphp
					<option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
				@endif
				@empty(old('subject_id'))
					<option value=""></option>
				@endempty
				@foreach ($subjects as $subject)	
					<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Thema auswählen:</label>
			</div>
			<select class="form-control custom-select" id="topic_id" name="topic_id">
				@if((old('topic_id')) !== null)
					@php 
						$topic_id_old = old('topic_id');
						$topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
					@endphp
					<option value="{{$topic_id_old}}">{{$topic_old->topic_title}}</option>
				@endif
				@empty(old('topic_id'))
					<option>Zuerst Fach auswählen</option>
				@endempty
			</select>
			<div class="col-md-2">
				<span id="loader" style="visibility: hidden;">
					<i class="far fa-spinner fa-spin"></i>
				</span>
			</div>
		</div>
		<hr></hr>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="subject_id">Gehört der Inhalt zu einem Lernportal?</label>
			</div>
			<select class="form-control custom-select" id="portal_id" name="portal_id">
				@if((old('portal_id')) !== null)
					@php 
						$portal_id_old = old('portal_id');
						$portal_old = App\Portal::where('id', '=' , $portal_id_old)->first();
					@endphp
					<option value="{{$portal_id_old}}">{{$portal_old->portal_title}}</option>
				@endif
				@empty(old('portal_id'))
					<option value="73"></option>
				@endempty
				@foreach ($portals as $portal)	
					<option value="{{$portal->id}}">{{$portal->portal_title}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="content_link">Link zum Inhalt:</label>
			</div>
			<input type="url" class="form-control" id="content_link" name="content_link" placeholder="URL hierhin kopieren" value="{{old('content_link')}}"></input>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="tool_id">Provider :</label>
			</div>
			<select class="form-control custom-select" id="tool_id" name="tool_id">
				@if((old('tool_id')) !== null)
					@php 
						$tool_id_old = old('tool_id');
						$tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
					@endphp
					<option value="{{$tool_id_old}}">{{$tool_old->tool_title}}</option>
				@endif
				@empty(old('portal_id'))
				<option value=""></option>
				@endempty
				@foreach ($tools as $tool)	
				<option value="{{$tool->id}}">{{$tool->tool_title}}</option>
				@endforeach}}
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="license">Lizenz:</label>
			</div>
			<select class="form-control custom-select" id="license" name="license">
				<option value="{{old('license')}}">{{old('license')}}</option>
				<option>Standard-Youtube-Lizenz</option>
				<option>CC-0</option>
				<option>CC BY</option>
				<option>CC BY-SA</option>
				<option>CC BY-ND</option>
				<option>CC BY-NC</option>
				<option>andere</option>
				<option>unbekannt</option>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<label class="input-group-text" for="content_type">Art des Lerninhalts:</label>
			</div>
			
			<select class="form-control custom-select" id="type_id" name="type_id">
				@if((old('type_id')) !== null)
					@php 
						$type_id_old = old('type_id');
						$type_old = App\Type::where('id', '=' , $type_id_old)->first();
					@endphp
					<option value="{{$type_id_old}}">{{$type_old->content_type}}</option>
				@endif
				@empty(old('type_id'))
				<option value=""></option>
				@endempty
				@foreach ($types as $type)
				<option value="{{$type->id}}">{{$type->content_type}}</option>
				@endforeach
			</select>
		</div>
		
		<!-- Geeignet für -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="didactics_type"> Geeignet für:</label>
			</div>
			<select class="form-control custom-select" id="didactics_type" name="didactics_type">
				<option value="{{old('didactics_type')}}">{{old('didactics_type')}}</option>
				<option>Einführung</option>
				<option>Vertiefung</option>
				<option>Nacharbeit</option>
				<option>Hausaufgabe</option>
				<option>Alle</option>
			</select>
		</div>
		
		<!-- How-to -->
		<div class="input-group mb-3">
    			<span class="form-control">Anleitung zum analogen Nachmachen (How-to)? </span>
    		<div class="input-group-append">
    			<div class="input-group-text">
      				<input value="1" type="checkbox" name="how_to" id="how_to">
    			</div>
  			</div>
		</div>
		
		
				<!-- Duration -->
			<div class="input-group mb-3">
  				<div class="input-group-prepend">
    				<span class="input-group-text">Länge des Inhalts: </span>
  				</div>
  				<input type="text" class="form-control" id="content_duration" name="content_duration" value="{{old('content_duration')}}">
 				<div class="input-group-append">
					<span class="input-group-text">Minuten</span>
				</div>
				<small class=" text-muted font-weight-small">Hier eine ganze Zahl an Minuten eingeben.</small>
			</div>
	
		
		
		<div class=" form-group form-control my-5">
			<label for="content_img"><i class="far fa-image"></i> Bild für den Inhalt hochladen</label>
			<input type="file" id="content_img" name="content_img">
		</div>
	
	<div class="mt-3">
	<h5>Optionale Daten:</h5>
	</div>
				
		<!-- Freie Tags -->	
		<small class="form-text text-muted">Neue Tags mit einem "@" beginnen</small>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tags:</span>
			</div>	
			<select class="custom-select select2-multi" name="tags[]" id="tags" multiple="multiple">
				<option value=""></option>
				@foreach ($tags as $tag)
				<option value="{{$tag->id}}">{{$tag->tag_name}}</option>
				@endforeach
			</select>
		</div>
			
		
		
		
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text"for="content_type">Geeignet für folgende Gerätegrößen:</label>
			</div>
			<select class="custom-select" name="devices[]" id="devices" multiple="multiple">
				@foreach ($devices as $device)
				<option value="{{$device->id}}">{{$device->device_type}}</option>
				@endforeach
			</select>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Technische/Sonstige Einschränkungen:</span>
			</div>
			<textarea class="form-control" name="technical_limitations" id="technical_limitations">{{old('technical_limitations')}}</textarea>
		</div>			

			
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Lerninhalt eintragen</button> 
		</div>
		
		</div>

		
</form>
</div>

@endsection

@section('scripts')
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $(".select2-multi").select2({
    	tags: true,
    	createTag: function (params) {
    		// Don't offset to create a tag if there is no @ symbol
			if (params.term.indexOf('@') === -1) {
      		// Return null to disable tag creation
      		return null;
    		}
    		return {
      		id: params.term,
      		text: params.term
    		}
  		}
    });
});
</script>

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
@endsection