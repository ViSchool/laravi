@extends ('backend.layout_backend')

@section('main')
   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
      <h3>Features für die Startseite</h3>
		@php
		 $countFeatured = App\Featured::all()->count();	 
		@endphp
		<div class="container my-3">
			@if ($countFeatured < 3)
				<div class="alert alert-info" role="alert">
  					Features werden derzeit nicht angezeigt. Alle drei Features müssen festgelegt sein, damit sie angezeigt werden.
				</div>
			@else
				<div class="d-flex form-group">
					<form action="/backend/featured_off" method="post">
						@csrf
						<input type="hidden" name="feature_switch">
						<button class="btn btn-warning" type="submit">Features nicht mehr anzeigen.</button>
					</form>
				</div>
			@endif
			
			
			
			<form method="POST" action="/backend/featured" enctype="multipart/form-data">
			@csrf
			<div class="card-deck">
				@isset($feature_01)
					@php
					if ($feature_01->serie_id > 0) {
						$feature1 = $feature_01->serie;
						$title1=$feature1->serie_title;
						$type1="Serie";
					}	 else {
						$feature1 = $feature_01->unit;
						$title1=$feature1->unit_title;
						$type1="Lerneinheit";
					}
					@endphp	
				@endisset
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 1</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature1">Hier das Feature 1 auswählen</label>
								<select class="custom-select" name="feature1" id="feature1">
									@if (isset($feature1->serie_title))
										<option value="serie|{{$feature1->id}}">{{$title1}} ({{$type1}})</option>	 
									@elseif (isset($feature1->unit_title))
										<option value="unit|{{$feature1->id}}">{{$title1}} ({{$type1}})</option>
									@else	 
										<option value="">Bitte auswählen</option> 
									@endif
									<optgroup label="Serien">
										@foreach ($series as $serie)
											<option value="serie|{{$serie->id}}">{{$serie->serie_title}}</option>
										@endforeach
									</optgroup>
									<optgroup label="Lerneinheiten">
										@foreach ($units as $unit)
											<option value="snit|{{$unit->id}}">{{$unit->unit_title}}</option>
										@endforeach
									</optgroup>
								</select>
								@if ($errors->has('feature1'))
									<span class="help-block">
										<strong>{{ $errors->first('feature1') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div> 
				
				@isset($feature_02)
					@php
					if ($feature_02->serie_id !== NULL) {
						$feature2 = $feature_02->serie;
						$title2=$feature2->serie_title;
						$type2="Serie";
					}	 else {
						$feature2 = $feature_02->unit;
						$title2=$feature2->unit_title;
						$type2="Lerneinheit";
					}
					@endphp
					@endisset	
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 2</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature2">Hier das Feature 2 auswählen</label>
								<select class="custom-select" name="feature2" id="feature2">
									@if (isset($feature2->serie_title))
										<option value="serie|{{$feature2->id}}">{{$title2}} ({{$type2}})</option>	 
									@elseif (isset($feature2->unit_title))
										<option value="unit|{{$feature2->id}}">{{$title2}} ({{$type2}})</option>
									@else	 
										<option value="">Bitte auswählen</option> 
									@endif
									<optgroup label="Serien">
										@foreach ($series as $serie)
											<option value="serie|{{$serie->id}}">{{$serie->serie_title}}</option>
										@endforeach
									</optgroup>
									<optgroup label="Lerneinheiten">
										@foreach ($units as $unit)
											<option value="snit|{{$unit->id}}">{{$unit->unit_title}}</option>
										@endforeach
									</optgroup>
								</select>
								@if ($errors->has('feature2'))
									<span class="help-block">
										<strong>{{ $errors->first('feature2') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div> 
				
				@isset($feature_03)
					@php
					if ($feature_03->serie_id > 0) {
						$feature3 = $feature_03->serie;
						$title3=$feature3->serie_title;
						$type3="Serie";
					}	 else {
						$feature3 = $feature_03->unit;
						$title3=$feature3->unit_title;
						$type3="Lerneinheit";
					}
					@endphp
					@endisset	
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 3</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature3">Hier das Feature 3 auswählen</label>
								<select class="custom-select" name="feature3" id="feature3">
									@if (isset($feature3->serie_title))
										<option value="serie|{{$feature3->id}}">{{$title3}} ({{$type3}})</option>	 
									@elseif (isset($feature3->unit_title))
										<option value="unit|{{$feature3->id}}">{{$title3}} ({{$type3}})</option>
									@else	 
										<option value="">Bitte auswählen</option> 
									@endif
									<optgroup label="Serien">
										@foreach ($series as $serie)
											<option value="serie|{{$serie->id}}">{{$serie->serie_title}}</option>
										@endforeach
									</optgroup>
									<optgroup label="Lerneinheiten">
										@foreach ($units as $unit)
											<option value="snit|{{$unit->id}}">{{$unit->unit_title}}</option>
										@endforeach
									</optgroup>
								</select>
								@if ($errors->has('feature3'))
									<span class="help-block">
										<strong>{{ $errors->first('feature3') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div> 
			</div>	
			<div class="d-flex justify-content-end mb-5">
				<button class="btn btn-warning" type="submit">Änderungen speichern</button>
			</div>
			</form>
		</div>
	
@endsection
