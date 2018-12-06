@extends ('backend.layout_backend')

@section('main')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Tool bearbeiten</h2>
          <hr></hr>

<div class="container">	
	<form method="POST" action="{{route('tools.update',[$tool->id])}}"  enctype="multipart/form-data">
		{{ csrf_field() }} {{ method_field('PATCH') }}
		<div class="form-group">
			<label for="tool_title">Name des Tools:</label>
			<input value="{{$tool->tool_title}}" type="text" class="form-control" id="tool_title" name="tool_title">
		</div>
		
		<div class="form-group">
			<label for="tool_description">Was ist es und wie funktioniert es?</label>
			<textarea class="form-control" name="tool_description" id="tool_description">{{$tool->tool_description}}</textarea>
		</div>
		
		<div class="form-group">
			<label for="embed_code">Mustercode zum Einbetten</label>
			<input value="{{$tool->embed_code}}" type="url" class="form-control" name="embed_code" id="embed_code"/>
		</div>	
		
		<div class="form-group">
			<label for="technical_requirements">Voraussetzung zur Nutzung ist mindestens folgende technische Ausstattung:</label>
			<select name="devices[]" id="devices" class="form-control" multiple="multiple">
				@foreach ($devices as $device)
				<option value="{{$device->id}}">{{$device->device_type}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			<label for="price_model">Kosten</label>
			<select name="price_model" id="price_model" class="form-control">
				<option>{{$tool->price_model}}</option>
				<option>kostenlos</option>
				<option>kostenlos für nicht-kommerzielle Nutzung</option>
				<option>beschränkte kostenlose Nutzung</option>
				<option>werbefinanziert</option>
				<option>Preis pro Benutzer</option>
				<option>Schullizenz</option>
				<option>Klassenlizenz</option>
			</select>
		</div>
		
		<div class="form-control mb-3">
			<label for="registration_for_create">Anmeldung zum Erstellen von Inhalten erforderlich: </label>
			<input 
				@if ($tool->registration_for_create == 1) 
					checked 
				@endif
			class="mb-3" value="1" type="checkbox" name="registration_for_create" id="registration_for_create"/>
			<label for="registration_for_use">Anmeldung zum Benutzen von Inhalten erforderlich: </label>
			<input class="mb-3" value="1" type="checkbox" name="registration_for_use" id="registration_for_use" @if ($tool->registration_for_use == 1) 
					checked 
				@endif />
		</div>
	

		<div class="form-group form-control">
			<label for="url_creation">URL zur Erstelllung von Inhalten:</label>
			<input value="{{$tool->url_creation}}" type="url" class="form-control" name="url_creation" id="url_creation"/>
			<label for="url_use">URL zum Nutzen des Inhalts:</label>
			<input value="{{$tool->url_use}}" type="url" class="form-control" name="url_use" id="url_use"/>
		</div>	
	
		<div class="form-group">
			<label for="didactics">Didaktische Hinweise:</label>
			<textarea class="form-control" name="didactics" id="didactics">{{$tool->didactics}}</textarea>
		</div>
		
		@isset ($tool->tool_img)
		<div>
			<img src="/images/tools/{{$tool->tool_img_thumb}}" class="img-fluid"></img>
		</div>
		@endisset

		<div class="custom-file form-group form-control my-5">
			<label class="custom-file-label" for="tool_img"><i class="far fa-image"></i> Bild für den Inhalt hochladen</label>
			<input class="custom-file-input" type="file" id="tool_img" name="tool_img">
		</div>
	
		<div class="form-group form-control">
			<label for="privacy_score">Datenschutzbewertung durch ViSchool</label>
			<select name="privacy_score" id="privacy_score">
				<option value="{{$tool->privacy_score}}">{{$tool->privacy_score}} von 5 Punkten</option>
				<option value="1">1 von 5 Punkten</option>
				<option value="2">2 von 5 Punkten</option>
				<option value="3">3 von 5 Punkten</option>
				<option value="4">4 von 5 Punkten</option>
				<option value="5">5 von 5 Punkten</option>
			</select> 
			<label for="privacy_description" class="mt-3">Erläuterungen/Link zum Datenschutz bzw. Nutzungsbedingungen:</label>
			<textarea class="form-control" name="privacy_description">{{$tool->privacy_description}}</textarea>
		</div>	
		
		<div class="form-group">
			<label for="tool_owner">Wer steckt dahinter:</label>
			<textarea class="form-control" name="tool_owner" id="tool_owner">{{$tool->tool_owner}}</textarea>
		</div>
	
	
		<div class="form-group">
			<label for="tutorials">Tutorials zum Tool:</label>
			<textarea class="form-control" name="tutorials" id="tutorials">{{$tool->tutorials}}</textarea>
		</div>
	
	
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Änderungen speichern</button> 
		</div>
	</form>	
	<hr></hr>
	
	<div class="form-group mt-5">
		<form method="POST" action="{{route('tools.destroy',$tool->id)}}">
			{{ csrf_field() }} {{ method_field('DELETE') }}
			<button class=" form-control btn btn-warning" type="submit"> Tool komplett löschen</button>
		</form>
	</div>
</div>

@include('layouts.errors')

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $("#devices").select2();
    $("#devices").select2().val({!!json_encode($tool->devices()->allRelatedIds())!!}).trigger('change');
});
</script>

@endsection