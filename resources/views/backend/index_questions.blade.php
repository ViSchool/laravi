@extends ('backend.layout_backend')

@section('main')
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h2>Testfragen administrieren für: </h2>
          <h4> {{$content->type->content_type}}: "{{$content->content_title}}"</h4> 

<div class="container">
	<p>Hier sind alle Testfragen hinterlegt, die zu einem Inhalt angezeigt werden können</p>
	@foreach ($questions as $question)
	<div class="row mb-3">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between">
				<div class="mr-3">
					{{$question->question}}
				</div>
				<a href="/backend/questions/show/{{$question->id}}"><i class="fas fa-pencil-alt"></i></a>
			</div> 
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						@isset ($question->answer1)
							<div class="mr-2">{{$question->answer1}}</div>
							@if ($question->solution1 === 1)
								<i class="fas fa-check" style="color: green;"></i>
							@else
								<i class="fas fa-times" style="color: red;"></i>
							@endif
						@endisset
						@empty ($question->answer1)
							<div class="text-muted">Antwort 1 ist leer</div>
						@endempty
					</div>	
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						@isset ($question->answer2)
							<div class="mr-2">{{$question->answer2}}</div>
							@if ($question->solution2 === 1)
								<i class="fas fa-check" style="color: green;"></i>
							@else
								<i class="fas fa-times" style="color: red;"></i>
							@endif
						@endisset
						@empty ($question->answer2)
							<div class="text-muted">Antwort 2 ist leer</div>
						@endempty	
					</div>
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						@isset ($question->answer3)
							<div class="mr-2">{{$question->answer3}}</div>
							@if ($question->solution3 === 1)
								<i class="fas fa-check" style="color: green;"></i>
							@else
								<i class="fas fa-times" style="color: red;"></i>
							@endif
						@endisset
						@empty ($question->answer3)
							<div class="text-muted">Antwort 3 ist leer</div>
						@endempty
					</div>	
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						@isset ($question->answer4)
						<div class="mr-2">{{$question->answer4}}</div>
						@if ($question->solution4 === 1)
							<i class="fas fa-check" style="color: green;"></i>
						@else
							<i class="fas fa-times" style="color: red;"></i>
						@endif
						@endisset
						@empty ($question->answer4)
							<div class="text-muted">Antwort 4 ist leer</div>
						@endempty
					</div>
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						@isset ($question->answer5)
							<div class="mr-2">{{$question->answer5}}</div>
							@if ($question->solution5 === 1)
								<i class="fas fa-check" style="color: green;"></i>
							@else
								<i class="fas fa-times" style="color: red;"></i>
						@endif
						@endisset
						@empty ($question->answer5)
							<div class="text-muted">Antwort 5 ist leer</div>
						@endempty
					</div>
				</li>
			</ul>
			<div class="card-footer d-flex justify-content-between align-items-center">
				<form method="POST" action="{{route('questions.destroy',[$question->id])}}">
					{{ csrf_field() }} {{ method_field('DELETE') }}
					<span>Diese Testfrage löschen:</span>
					<button type="submit">Löschen</button>
				</form>
			</div>
		</div>
		</div>
	@endforeach
	<hr></hr>
		<a class="btn btn-primary mb-5" href="/backend/questions/create/{{$content->id}}">Neue Testfrage hinzufügen </a>
</div>
@endsection
