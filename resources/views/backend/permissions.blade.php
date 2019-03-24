@extends ('backend.layout_backend')

@section('main')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Benutzerrechte - Übersicht</h1>
@include('layouts.errors')
<div class="container">
	<div class="row mb-3">
		<a class="btn btn-primary" data-toggle="collapse" href="#createPermission">Neue Aufgabe anlegen</a>
		<div class="collapse" id="createPermission">
			<form method="POST" action="/backend/permissions">
				{{ csrf_field() }}
			<div class="card card-body">
				<div class="form-group">
					<label for="name">Name der Aufgabe:</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
		
				<div class="form-group">
					<label for="role">Aufgabe für folgende Benutzer erlauben (Mehrfachauswahl möglich):</label>
					<select class="form-control select2-multi" name="roles[]" id="roles" multiple="multiple">
						<option value="">Keine</option>
						@foreach ($roles as $role)
							<option value="{{$role->id}}">{{$role->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Neue Aufgabe speichern</button>
				</div>
			</div>
			</form>
		</div>
	</div>
		
	<form method="POST" action="{{route('permissions.update')}}">
	@csrf @method('PATCH')
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Aufgaben</th>
				@foreach ($roles as $role )
					<th>{{$role->name}}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach ($permissions->sortBy('id') as $permission)
				<tr>
					<td>{{$permission->name}}</td>
					@foreach ($roles->sortBy('id') as $role)
						<td class="align-middle text-center">			
							<input class="form-check-input" type="checkbox" name="permission-{{$permission->id}}-{{$role->id}}" id="permission-{{$permission->id}}-{{$role->id}}" @if ($role->hasPermissionTo($permission->name)) checked @endif>
						</td>	
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
	<hr>
	<div class="d-flex form-group justify-content-end">
		<button type="submit" class="btn btn-primary">Änderungen speichern</button>
	</div>
	</form>
	
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
    $('.select2-multi').select2();
});
</script>
@endsection