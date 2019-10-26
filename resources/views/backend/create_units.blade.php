@extends ('backend.layout_backend')

@section('main')
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Unterrichtseinheit anlegen</h2>
          <hr></hr>

<div class="container">
	@include('layouts.errors')
	<div class="card w-75">
		<div class="card-header text-center bg-warning">
			<h5>Neue Lerneinheit</h5>
		</div>
	<form class="my-3 " method="POST" action="/backend/units" enctype="multipart/form-data">
		{{ csrf_field() }}
			
			<div class="form-group">
				<label for="unit_title" class="col-md-6 col-form-label">Titel der Lerneinheit:</label>
				<div class="col-md-10">
				<input id="unit_title" type="text" class="form-control {{$errors->has('unit_title') ? 'is-invalid' : ''}}" name="unit_title" value="{{old('unit_title')}}" required autofocus>
					@if ($errors->has('unit_title'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('unit_title') }}</strong>
						</span>
					@endif
				</div>
			</div>
			
			<div class="form-group mb-3">
				<label for="unit_description" class="col-md-6 col-form-label">Kurzbeschreibung der Lerneinheit:</label>
				<div class="col-md-10">
					<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description"></textarea>
					@if ($errors->has('unit_description'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('unit_description') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Fach:</label>
					</div>
					<select class="form-control custom-select {{$errors->has('subject_id') ? 'is-invalid' : ''}}" id="subject_id" name="subject_id" required autofocus>
						<option value=""></option>
						@foreach ($subjects as $subject)	
							<option value="{{$subject->id}}">{{$subject->subject_title}}</option>
						@endforeach
					</select>
					@if ($errors->has('subject_id'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('subject_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Thema:</label>
					</div>
					<select class="form-control custom-select {{$errors->has('topic_id') ? 'is-invalid' : ''}}" id="topic_id" name="topic_id" required autofocus>
						<option>Zuerst Fach auswählen</option>
					</select>
					@if ($errors->has('topic_id'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('subject_id') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Serie:</label>
					</div>
					<select class="form-control custom-select" id="serie_id" name="serie_id">
						<option value="">Gehört zu keiner Serie</option>
						@foreach ($series as $serie)
							<option value={{$serie->id}}>{{$serie->serie_title}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
            		<label for="differentiation_id" class="input-group-text">Differenzierung:</label>
					</div>
					<select class="form-control custom-select" name="differentiation_group" id="differentiation_group">
                  <option value="">Keine Differenzierung</option>
                  @isset($differentiation_groups)
                     @foreach ($differentiation_groups as $differentiation_group)
                        <option value="{{$differentiation_group}}">{{$differentiation_group}}</option>
                     @endforeach
                  @endisset
                  <option value="Standard">Standard</option>
               </select>
            </div>
         </div>

			<div class="col-md-10 mb-3">
				<div class="row">
					<div class="col-5">
						<div id="noImage" class="card">
							<img class="img-fluid card-img" src="/images/topic_back.jpeg"></img>
							<div class="card-img-overlay d-flex justify-content-center">
								<small class="text-white">Noch kein Bild ausgewählt</small>
							</div>
						</div>
						<div id="hasImage" class="d-none">
							<img class="img-fluid card-img" id="imgUpload" src="#" alt="your image" />
						</div>
					</div>
					<div class="col-7 d-flex flex-column align-self-center">
						<label class="" for="unit_img"><i class="far fa-image"></i> Titelbild für die Lerneinheit</label>
						<input class="form-control-file" type="file" id="imgInp" name="unit_img" style="color:transparent;">
					</div>
				</div>
			</div>



			<div class="col-md-10">
				<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Lerneinheit speichern</button> 
				</div>
			</div>
		
		
	</div>
	
</form>
</div>
</div>

@endsection

@section('scripts')
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $(".select2-multi").select2({
    	tags: true,
    	createTag: function (params) {
    		// Don't offset to create a tag if there is no @ symbol
			if (params.term.indexOf('@') === -1) {
      		// Return null to disable tag creation
      		return null;
    		}
    		return {
      		id: params.term,
      		text: params.term
    		}
  		}
    });
});
</script>
<script src="{{asset('js/preview_upload_image.js')}}"></script>

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
@endsection