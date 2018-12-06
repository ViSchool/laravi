@extends ('backend.layout_backend')

@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
@endsection
@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <div class="container">
          <h2>{{$unit->unit_title}}</h2>
          </div>
          <hr></hr>

<div class="container">
@include('layouts.errors')

	<form method="POST" action="{{route('backend.units.update',[$unit->id])}}" enctype="multipart/form-data">
	{{ csrf_field() }} {{ method_field('PATCH') }}
		<div class="form-group">
			<div class="input-group mb-3">
				<div class="input-group-prepend"> 
					<label class="input-group-text">Titel der Unterrichtseinheit:</label>
				</div>
				<input value="{{$unit->unit_title}}" type="text" class="form-control" id="unit_title" name="unit_title">
			</div>
		</div>
		<div class="form-group mb-3">
				<label class="mb-1">Kurzbeschreibung der Unterrichtseinheit:</label>
			<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description">{{$unit->unit_description}}</textarea>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
				<option value="{{$unit->subject_id}}">{{$unit->subject->subject_title}}</option>
				@foreach ($subjects as $subject)	
				<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Anderes Thema auswählen:</label>
			</div>
			<select class="form-control custom-select" id="topic_id" name="topic_id">
				<option value="{{$unit->topic_id}}">{{$unit->topic->topic_title}}</option>
				@foreach ($currentSubject->topics as $topic)
				<option value="{{$topic->id}}">{{$topic->topic_title}}</option>
				@endforeach
			</select>
			<div class="col-md-2">
				<span id="loader" style="visibility: hidden;">
					<i class="far fa-spinner fa-spin"></i>
				</span>
			</div>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Unterrichtseinheit gehört zur Serie:</label>
			</div>
			<select class="form-control custom-select" id="series" name="series">
				@isset($currentSerie->id)
				<option value={{$currentSerie->id}}>{{$currentSerie->serie_title}}</option>
				@endisset
				<option value="">Gehört zu keiner Serie</option>
				@foreach ($unit->series as $serie)
					<option value="{{$serie->id}}">{{$serie->serie_title}}</option>
				@endforeach
			</select>
		</div>
		@isset($unit->unit_img)
		<div>
			<img class="img-fluid" src="/images/units/{{$unit->unit_img_thumb}}"></img>
		</div>
		@endisset
		<div class=" form-group form-control my-5">
			<label for="unit_img"><i class="far fa-image"></i> Bild für die Einheit hochladen</label>
			<input type="file" id="unit_img" name="unit_img"></input>
		</div>
		
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Änderungen für die Unterrichtseinheit speichern</button> 
		</div>
	</form>

	<hr></hr>
	@isset($unit->blocks)
	<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es bereits {{$unit->blocks->count()}} Aufgaben:</h5>

    	<table class="table">
			<thead>
				<tr>
					<th>Aufgabe</th>
					<th>Titel der Aufgabe</th>
					<th>Reihenfolge ändern</th>
				</tr>
			</thead>
			<tbody class="sortable">
				@php
					$maxOrder = $unit->blocks->max('order');
					$minOrder = $unit->blocks->min('order');
				@endphp
				@foreach($unit->blocks->sortBy('order') as $block)
				<tr>
					<td><a href="/backend/blocks/{{$block->id}}">Aufgabe bearbeiten</a></td>
					<td>
					@isset($block->alternative)
					<i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i>
					@endisset
					{{$block->title}} ({{$block->differentiation->differentiation_title}})</td>	
					<td>
						@if ($block->order != $minOrder)
						<form method="POST" action="{{route('backend.blocks.update_orderup', $block->id)}}">
						{{ csrf_field() }} {{ method_field('PATCH') }} 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-up"></i></button>
						</form>
						@endif
						@if ($block->order != $maxOrder)
						<form method="POST" action="{{route('backend.blocks.update_orderdown', $block->id)}}">
						{{ csrf_field() }} {{ method_field('PATCH') }} 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-down"></i></button>
						</form>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endisset

	@empty($unit->blocks)
		<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es noch keine Aufgaben.</h5>
	@endempty

	<div>
		<a href="/backend/blocks/{{$unit->id}}/create1" class="btn btn-primary mb-3 form-control">Neue Aufgabe einfügen</a>
	</div>
	
	<div class="form-group">
		<form method="POST" action="{{route('backend.units.destroy',[$unit->id])}}">
			{{ csrf_field() }} {{ method_field('DELETE') }}
			<button class=" form-control btn btn-warning" type="submit"> Lerneinheit komplett löschen</button>
		</form>
	</div>
</div>

@include('layouts.errors')
@endsection

@section('scripts')
<script type="text/javascript">
	$( function() {
	$(".sortable").sortable();
	$(".sortable").disableSelection();
	});
</script>
@endsection