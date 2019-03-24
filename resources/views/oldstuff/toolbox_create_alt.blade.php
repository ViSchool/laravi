@extends('layout_teacher')
		
@section ('page-header')

	<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheiten erstellen</h4>
		
	</div>
	</section>
@endsection
		
@section ('content')
<div class="row m-0 p-0">
	<div class="col-11 col-md-8 m-3">
		<div class="alert alert-warning d-md-none d-lg-none">
			<p class="lead">Die Toolbox zum Erstellen eigener Unterrichtseinheiten ist für die Benutzung mit Tablets oder größeren Bildschirmen konzipiert. Die Toolbox funktioniert deshalb nicht auf dem Smartphone.</p>
			@include('layouts.errors')
		</div>
	@if (isset($unit->id))
				<form method="POST" action="{{route('unit.edit',[$unit->id])}}" enctype="multipart/form-data">
				{{ csrf_field() }} {{method_field('PATCH')}}
				@else
				<form method="POST" action="{{route('unit.store')}}" enctype="multipart/form-data">
				{{ csrf_field() }} 
				@endif
					<div class="form-group mt-3">
						<label style="color:white; font-size:1.25rem;" for="subject_id">Fach auswählen:</label>
						<select class="form-control form-control-lg" id="subject_id" name="subject_id">
							@if (isset($unit->id))
							<option value="{{$unit->subject_id}}">{{$unit->subject->subject_title}}</option>
							@else
							<option value=""></option>
							@endif
							@foreach ($subjects as $subject)	
							<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
							@endforeach
						</select>
						
						<label style="color:white; font-size:1.25rem;" for="topic_id">Thema auswählen:</label>
						<select class="form-control form-control-lg" id="topic_id" name="topic_id">
							@if (isset($unit->id))
							<option value="{{$unit->topic_id}}">{{$unit->topic->topic_title}}</option>
							@else
							<option>Zuerst Fach auswählen</option>
							@endif
						</select>
						<div class="col-md-2">
							<span id="loader" style="visibility: hidden;">
								<i class="far fa-spinner fa-spin"></i>
							</span>
						</div>

						<label style="color:white; font-size:1.25rem;" for="unit_title">Titel der Unterichtseinheit:</label>
						@if(isset($unit->id))
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title" value="{{$unit->unit_title}}"/>
						@else
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title"/>	
						@endif
						<label style="color:white; font-size:1.25rem;" for="unit_description">Lernziel/Beschreibung der Unterichtseinheit:</label>
						<textarea class="form-control" id="unit_description" name="unit_description" aria-label="unit_description" aria-describedby="unit_description">@if(isset($unit->id)){{$unit->unit_description}}@endif</textarea>
						<button class="badge border-primary bg-primary p-2 my-3" type="submit">Lerneinheit speichern</button>
					
					</div>
				</form>
			</div>

	</div>
</div>	
@endsection

@section('scripts')
<script src="{{asset('js/add_block.js')}}"></script>
<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
		
@endsection	