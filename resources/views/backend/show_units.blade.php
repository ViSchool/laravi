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
	<div class="card">
		<div class="card-header text-center bg-warning">
			<h5>Lerneinheit bearbeiten</h5>
		</div>
		<form class="my-3" method="POST" action="{{route('backend.units.update',[$unit->id])}}" enctype="multipart/form-data">
		{{ csrf_field() }} {{ method_field('PATCH') }}
			
			<div class="form-group">
				<label for="unit_title" class="col-md-6 control-label">Titel der Unterrichtseinheit:</label>
				<div class="col-lg-10">
					<input id="unit_title" type="text" class="form-control {{ $errors->has('unit_title') ? 'invalid' : '' }}" name="unit_title" value="{{$unit->unit_title}}" required autofocus>
					@if ($errors->has('unit_title'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('unit_title') }}</strong>
						</span>
					@endif
				</div>
			</div>


			<div class="form-group mb-3">
				<label for="unit_description" class="col-md-6 control-label">Kurzbeschreibung der Unterrichtseinheit:</label>
				<div class="col-lg-10">
					<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description">{{$unit->unit_description}}</textarea>
					@if ($errors->has('unit_description'))
						<span class="help-block">
							<strong class="text-danger">{{ $errors->first('unit_description') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Fach:</label>
					</div>
					<select class="form-control custom-select" id="subject_id" name="subject_id" required autofocus>
						<option value="{{$unit->subject_id}}">{{$unit->subject->subject_title}}</option>
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
			
			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Thema:</label>
					</div>
					<select class="form-control custom-select" id="topic_id" name="topic_id">
						<option value="{{$unit->topic_id}}">{{$unit->topic->topic_title}}</option>
						@foreach ($currentSubject->topics as $topic)
						<option value="{{$topic->id}}">{{$topic->topic_title}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Serie:</label>
					</div>
					<select class="form-control custom-select" id="serie" name="serie">
						@isset($currentSerie)
						<option value={{$currentSerie->id}}>{{$currentSerie->serie_title}}</option>
						@endisset
						<option value="">Gehört zu keiner Serie</option>
						@foreach ($series as $serie)
							<option value="{{$serie->id}}">{{$serie->serie_title}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
      				<label for="differentiation_id" class="input-group-text">Differenzierung:</label>
					</div>
					<select class="form-control custom-select" name="differentiation_group" id="differentiation_group">
						@isset($unit->differentiation_group)
							<option value="{{$unit->differentiation_group}}">{{$unit->differentiation_group}}</option>
						@endisset
                	@isset($differentiation_groups)
                  	@foreach ($differentiation_groups as $differentiation_group)
                  		<option value="{{$differentiation_group}}">{{$differentiation_group}}</option>
                  	@endforeach
                  @endisset
						  <option value="Standard">Standard</option>
						  <option value="">Keine Differenzierung</option>
               </select>
            </div>
         </div>

			<div class="col-lg-10 mb-3">
				<div class="row">
					<div class="col-5">
						@isset($unit->unit_img)
							<div class="card">
								<img class="img-fluid card-img" src="/images/units/{{$unit->unit_img_thumb}}"></img>
							</div>
						@endisset
						@empty($unit->unit_img)
						<div id="noImage" class="card">
							<img class="img-fluid card-img" src="/images/topic_back.jpeg"></img>
							<div class="card-img-overlay d-flex justify-content-center">
								<small class="text-white">Noch kein Bild ausgewählt</small>
							</div>
						</div>
						<div id="hasImage" class="d-none">
							<img class="img-fluid card-img" id="imgUpload" src="#" alt="your image" />
						</div>
						@endempty
					</div>
					<div class="col-7 d-flex flex-column align-self-center">
						<label class="" for="unit_img"><i class="far fa-image"></i> Titelbild für die Lerneinheit</label>
						<input class="form-control-file" type="file" id="imgInp" name="unit_img" style="color:transparent;">
					</div>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend ">
						<label class="input-group-text bg-warning" for="status_id">Status:</label>
					</div>
					<select class="form-control custom-select" id="status_id" name="status_id">
						<option value="{{$unit->status_id}}">Aktueller Status: {{$unit->status->status_name}}</option>
						@foreach ($statuses as $status)
						<option value="{{$status->id}}"> Ändern in: {{$status->status_name}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Änderungen speichern</button> 
				</div>
			</div>
		</form>
	</div>

	<hr>
	@if(count($unit->blocks) > 0)
	<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es bereits {{$unit->blocks->count()}} Aufgaben:</h5>

    	<table class="table  table-sm">
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
				@if (count($unit->blocks->where('order',$block->order)) > 1)
					<tr class="table-info">
				@else 
					<tr>
				@endif
					<td><a href="/backend/blocks/{{$block->id}}">Aufgabe bearbeiten</a></td>
					<td>
						@if (count($unit->blocks->where('order',$block->order)) > 1)
							<i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i><br>
						@endif
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
	@else 
		<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es noch keine Aufgaben.</h5>
	@endif

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
<script src="{{asset('js/preview_upload_image.js')}}"></script>
<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
@endsection