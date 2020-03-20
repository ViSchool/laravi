@extends ('backend.layout_backend')

@section('main')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4>Neue Serie anlegen</h4>

<div class="container">	
	@include('layouts.errors')
	<form method="POST" action="/backend/series">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="{{old('serie_title')}}">
		</div>
		
		<div class="form-group{{ $errors->has('serie_description') ? ' invalid' : '' }}">
            <label for="task" class="col-10 col-form-label mb-0 pb-0">Beschreibung der Serie</label>
            <label for="task" class="col-10 col-form-label mt-0 pt-0">
				<small class="text-muted"> Hier kannst Du beschreiben, welche Inhalte in der Serie enthalten sind.</small>
			</label>
			<div class="border">
				<textarea id="serie_description" rows="3" class="form-control" name="serie_description" >{{old('serie_description')}}</textarea>
         	@if ($errors->has('serie_description'))
            <span class="help-block">
               <strong>{{ $errors->first('serie_description') }}</strong>
            </span>
				@endif
			</div>
		</div>
			
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Serie anlegen</button>
		</div>
	</form>
</div>
@endsection

@section('scripts')



@endsection
