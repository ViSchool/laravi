@extends ('layout')
		
		@section ('page-header')

	

		@endsection
		
@section ('content')
<h2>Registrieren</h2>
	<form method="POST" action="{{route ('register.store')}}">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			 <input type="text" class="form-control" id="email" name="email" required>
		</div>
		<div class="form-group">
			<label for="password">Passwort:</label>
			 <input type="password" class="form-control" id="password" name="password" required>
		</div>
		<div class="form-group">
			<label for="password_confirmation">Passwort bestätigen:</label>
			 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Registrieren</button>
		</div>
	@include('layouts.errors')
	</form>

		@endsection
		
