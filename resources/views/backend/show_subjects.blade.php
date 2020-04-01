@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Fach bearbeiten</h1>

<div class="container">
	<div class="container">	
 	<form method="POST" action="{{route('subjects.update',[$subject->id])}}">
		{{ csrf_field() }} {{ method_field('PATCH') }}
		
		<div class="form-group">
			<label for="subject_title">Fachname:</label>
			<input type="text" class="form-control" id="subject_title" name="subject_title" value="{{$subject->subject_title}}">
		</div>

	
		{{-- <div class="mb-3 border bg-info p-2">
			<h5 class="text-white">Features für die ViSchool Startseite</h5><br>
			<div class="card-deck ">
				<div class="card">
					<div class="card-header">
						<label for="feature1"> Feature 1: </label>
					</div>
					<select class="custom-select" name="feature1" id="feature1">
						<option value="">Bitte auswählen</option>
						<optgroup label="Serien">
							@foreach($series as $serie)
								<option value="{{$serie->id}}">{{$serie->serie_title}}</option>
							@endforeach
						</optgroup>
						<optgroup label="Lerneinheiten">
						@foreach ($subject->units as $unit)
							<option value="{{$unit->id}}">{{$unit->unit_title}}</option>
						@endforeach
						</optgroup>
					</select>
				</div>

				<div class="card">
					<div class="card-header">
						<label for="feature1"> Feature 2: </label>
					</div>
					<select class="custom-select" name="feature2" id="feature2">
						<option value="">Bitte auswählen</option>
						<optgroup label="Serien">
							@foreach ($series as $serie)
								<option value="{{$serie->id}}">{{$serie->serie_title}}</option>
							@endforeach
						</optgroup>
						<optgroup label="Lerneinheiten">
						@foreach ($subject->units as $unit)
							<option value="{{$unit->id}}">{{$unit->unit_title}}</option>
						@endforeach
						</optgroup>
					</select>
				</div>

				<div class="card">
					<div class="card-header">
						<label for="feature1"> Feature 3: </label>
					</div>
					<select class="custom-select" name="feature3" id="feature3">
						<option value="">Bitte auswählen</option>
						<optgroup label="Serien">
							@foreach ($series as $serie)
								<option value="{{$serie->id}}">{{$serie->serie_title}}</option>
							@endforeach
						</optgroup>
						<optgroup label="Lerneinheiten">
						@foreach ($subject->units as $unit)
							<option value="{{$unit->id}}">{{$unit->unit_title}}</option>
						@endforeach
						</optgroup>
					</select>
				</div>
			</div>
		</div> --}}

		<div class="form-group">
			<p>Der folgende Icon wird für {{$subject->subject_title}} angezeigt:</p>
			<p class="fa-3x"><i class="{{$subject->subject_icon}}"></i></p>
			<label for="subject_icon">Neues Icon auwählen: </label>
			<select class="form-control" id="subject_icon" name="subject_icon">
				<option>{{$subject->subject_icon}}</option>
				@foreach ($icons as $icon)
				<option value="{{$icon->icon_title}}">{{$icon->icon_title}}: &#x{{$icon->icon_number}}</option>
				@endforeach			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	@include('layouts.errors')
	</form>
	<hr></hr>
		<div class="form-group">
			<form method="POST" action="{{route('subjects.destroy',[$subject->id])}}">
				{{ csrf_field() }} {{ method_field('DELETE') }}
					<button class="btn btn-warning" type="submit"> Fach komplett löschen</button>
			</form>
		</div>
				

</div>

<hr></hr>
<div class = "container">
<h4>Themen im Fach {{$subject->subject_title}}</h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name des Themas</th>
					<th>Anzahl der Inhalte</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($subject->topics->sortBy('topic_title') as $topic)
				<tr>
					<td><a href="/backend/topics/{{$topic->id}}">{{$topic->topic_title}}</a></td>	
					<td>{{$topic->content()->count()}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>	
</div>
@endsection
