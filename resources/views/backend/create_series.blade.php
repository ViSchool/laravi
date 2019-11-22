@extends ('backend.layout_backend')

@section('main')

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4>Neue Serie mit Lerneinheiten anlegen</h4>

<div class="container">	
	@include('layouts.errors')
	<form method="POST" action="/backend/series">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="{{old('serie_title')}}">
		</div>
		<div class="form-group">
			<textarea id="serie_description" name="serie_description" aria-label="serie_description" aria-describedby="serie_description">{{old('serie_description')}}</textarea>
		</div>
		<div class="form-group">
			<label for="public">Sichtbarkeit der Serie:</label>
			<select id="public" name="public">
				<option value="1">Frontend und Backend</option>
				<option value="0">nur Backend</option>
			</select>
		</div>	
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Serie anlegen</button>
		</div>
	</form>
</div>
@endsection
