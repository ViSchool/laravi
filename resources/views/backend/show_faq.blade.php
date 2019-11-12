@extends ('backend.layout_backend')

@section ('stylesheets')
@endsection

@section('main')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <h1>FAQs erstellen </h1>
	<div class="container">	
	<form method="POST" action="/backend/faq/{{$faq->id}}" enctype="multipart/form-data">
			@csrf @method('PATCH')
			<div class="form-group">
				<label for="faq_category">Kategorie:</label>
			<input class="form-control" type="text" list="categories" id="faq_category" name="faq_category" placeholder="Kategorie auswählen oder eine Neue eintragen" value="{{$faq->faq_category}}"/>
				<datalist id="categories">
					@foreach ($categories as $category)
						<option>{{$category}}</option>
					@endforeach
				</datalist>
				@if ($errors->has('faq_category'))
					<span class="help-block">
						<strong class="text-danger">{{ $errors->first('faq_category') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="faq_question">Frage:</label>
			<input type="text" class="form-control" id="faq_question" name="faq_question" value="{{$faq->faq_question}}">
				@if ($errors->has('faq_question'))
					<span class="help-block">
						<strong class="text-danger">{{ $errors->first('faq_question') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="faq_answer">Antwort:</label>
			<textarea class="form-control" id="faq_answer" name="faq_answer">{{$faq->faq_answer}}</textarea>
				@if ($errors->has('faq_answer'))
					<span class="help-block">
						<strong class="text-danger">{{ $errors->first('faq_answer') }}</strong>
					</span>
				@endif
			</div>	
			<button type="submit" class=" form-control btn btn-primary">Frage speichern</button>		
		</form>
	</div>
</main>

@endsection

@section('scripts')
@endsection
