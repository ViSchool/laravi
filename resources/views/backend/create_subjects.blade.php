@extends ('backend.layout_backend')

@section('main')

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Fächer administrieren</h1>

<div class="container">	
	<form method="POST" action="/backend/subjects">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="subject_title">Fachname:</label>
			<input type="text" class="form-control" id="subject_title" name="subject_title">
		</div>
		<div class="form-group">
			<label for="subject_icon">Icon:</label>
			<select class="form-control mb-4" id="subject_icon" name="subject_icon">
				<option>Bitte Icon auswählen</option>
				@foreach ($icons as $icon)
				<option value="{{$icon->icon_title}}">{{$icon->icon_title}}: &#x{{$icon->icon_number}}</option>
				@endforeach
			</select>
			<label>Übersichtsseite für Icons:</label>
			<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Font Awesome Gallery</a>
		</div>
		
		
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Fach eintragen</button>
		</div>
	@include('layouts.errors')
	</form>
</div>
@endsection
