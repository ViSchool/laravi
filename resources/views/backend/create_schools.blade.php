@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		  <h1>Neue Schule anlegen</h1>
		  
@include('layouts.errors')

<div class="container">	
	<form method="POST" action="/backend/schools" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="school_name">Name der Schule:</label>
	<input type="text" class="form-control mb-3" id="school_name" name="school_name" value="{{old('school_name')}}">

		<label for="school_vischoolUrl">ViSchool-URL der Schule: (vischool.de/Schule)</label>
		<input type="text" class="form-control mb-3" id="school_vischoolUrl" name="school_vischoolUrl" value="{{old('school_vischoolUrl')}}">
			
		<label for="school_type">Schulart auswählen:</label>
		<select class="form-control  mb-3" id="school_type"" name="school_type">
		<option value="{{old('school_type')}}">Bitte wählen</option>
		<option>Gymnasium</option>
		<option>Realschule</option>
		<option>Hauptschule</option>
		<option>Berufsschule/Berufskolleg</option>
		<option>Gesamtschule</option>
		</select>

		<label for="school_street">Adresse der Schule:</label>
		<input type="text" class="form-control  mb-3" id="school_street" name="school_street" value="{{old('school_street')}}">

		<label for="school_zip_code">PLZ der Schule:</label>
		<input type="number" class="form-control mb-3" id="school_zip_code" name="school_zip_code" value="{{old('school_zip_code')}}">

		<label for="school_city">Stadt:</label>
		<input type="text" class="form-control mb-3" id="school_city" name="school_city" value="{{old('school_city')}}">

		<label for="school_email">Emailadresse der Schule:</label>
		<input type="email" class="form-control mb-3" id="school_email" name="school_email" value="{{old('school_email')}}">

		<label for="school_contact">Ansprechpartner der Schule:</label>
		<input type="text" class="form-control mb-3" id="school_contact" name="school_contact" value="{{old('school_contact')}}">

		<label for="school_phone">Telefonnummer des Ansprechpartners:</label>
		<input type="tel" class="form-control mb-3" id="school_phone" name="school_phone" value="{{old('school_phone')}}">

		<label for="school_accountStatus">Status des Schulaccounts:</label>
		<select class="form-control mb-3" id="school_accountStatus"" name="school_accountStatus">
		<option value="open">geöffnet (Schul-URL ist live)</option>
		<option value="closed">geschlossen (nicht über Schul-URL erreichbar)</option>
		<option value="archived">archiviert (nicht über Schul-URL erreichbar)</option>
		</select>

		<label for="school_comments">Anmerkungen zur Schule:</label>
		<textarea class="form-control mb-3" name="school_comments" id="school_comments" rows="10">{{old('school_comments')}}</textarea>

		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Schule anlegen</button>
		</div>
	</form>
</div>
@endsection

@section('scripts')

@endsection