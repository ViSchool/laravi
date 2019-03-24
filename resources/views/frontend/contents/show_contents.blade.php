@extends ('layout')

@section ('stylesheets')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="/js/jsPDF/html2canvas.min.js"></script>


@endsection

@section ('page-header')
<section id="page-header">
<div class="container p-3">
	<h4>Einzelne Lerninhalte</h4>
</div>
</section>
@endsection
		
@section ('content')

<div class="container">
	{!!$breadcrumbs->render()!!}
</div>

<div id="embedded-content" class="container">	
	<div class="row">
		<div class="col">
			<h3>{{$content->content_title}}</h3>
		</div>
	</div>
	<div class="row">
		<div class="col">	
			@include('components.rating_stars',['$average_score' => $average_score])
		</div>
		<div class="col">
			<div class="d-flex flex-row-reverse mb-1">
			<button type="button" class="btn-sm btn-outline-danger" id="open"> Fehler entdeckt ?</button>
			</div>
		</div>
	</div>

	<hr>
	@if (\Session::has('success'))
    	<div class="alert alert-success">
         <p>{!! \Session::get('success') !!}</p>
    	</div>
	@endif
	<div class="row">
		<div id="contentToPrint" class="col">	
			@switch($content->tool_id) 
				@case(1)
					<div class="embed-responsive embed-responsive-{{$aspect_ratio}}">
						<iframe src="https://www.youtube-nocookie.com/embed/{{$content->toolspecific_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				@break
				@case(4)
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<div class="container">
							<a href="{{$content->content_link}}"><small class="text-muted">Quelle: {{$content->content_link}}</small></a>
						</div>
						<iframe src="{{$content->content_link}}" style="width:600px height:800px" allowfullscreen>Der Browser zeigt leider das Dokument nicht richtig an. Hier ist der Inhalt zum Anschauen in einem neuen Fenster: <a href="{{$content->content_link}}">{{$content->content_title}}</a></iframe>
					</div>
				@break
				@case(5) 
					<div class="d-flex justify-content-end">
						<a href="{{$content->content_link}}"> Als PDF öffnen <i class="far fa-file-pdf fa-2x" style="color:red"></i> </a>			
					</div>

					<object id="obj" data="{{$content->content_link}}" ></object>	
				@break
				@case(6) 
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<p><iframe src="https://h5p.org/h5p/embed/{{$content->toolspecific_id}}" frameborder="0" allowfullscreen="allowfullscreen" style="width:70% "></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>
					</div>
					
					<object id="obj" data="://h5p.org/h5p/embed/{{$content->toolspecific_id}}" ></object>	
				@break
				@case(7)
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="https://player.vimeo.com/video/{{$content->toolspecific_id}}?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				@break
			@endswitch
		</div>	
	</div>
	@if($question != null)
	<div class="row mt-3">
		<div class="col">
			<div class="d-flex flex-row-reverse my-2">
				<button type="button" class="btn-sm btn-info" id="question"> Alles verstanden? Teste Dich selbst!</button>
			</div>
		</div>
	</div>
	@endif
	<hr>
</div>




<!-- Block Berwertung -->
<div class="container">
	<h3>Bewerten</h3>
	<form action="/reviews" method="POST">
		{{ csrf_field() }}
		<!-- AHA Review -->
		<div class="row">
			<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_aha.jpg" alt="AHA!" width="60"></img>
	 				<div class="pt-2">
						<div class="rating">
							<input id="star1_aha" type="radio" name="aha_score" value="5">
							<label for="star1_aha"></label>
							<input id="star2_aha" type="radio" name="aha_score" value="4">
							<label for="star2_aha"></label>
							<input id="star3_aha" type="radio" name="aha_score" value="3">
							<label for="star3_aha"></label>
							<input id="star4_aha" type="radio" name="aha_score" value="2">
							<label for="star4_aha"></label>
							<input id="star5_aha" type="radio" name="aha_score" value="1">
							<label for="star5_aha"></label>
						</div>
					</div>
				</div>
			</div>	
			
			<!-- COOL Review -->	
			
			<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_cool.jpg" alt="COOL!" width="60"></img>
	 				<div class="pt-2">
						<div class="rating">
							<input id="star1_cool" type="radio" name="cool_score" value="5">
							<label for="star1_cool"></label>
							<input id="star2_cool" type="radio" name="cool_score" value="4">
							<label for="star2_cool"></label>
							<input id="star3_cool" type="radio" name="cool_score" value="3">
							<label for="star3_cool"></label>
							<input id="star4_cool" type="radio" name="cool_score" value="2">
							<label for="star4_cool"></label>
							<input id="star5_cool" type="radio" name="cool_score" value="1">
							<label for="star5_cool"></label>
						</div>
					</div>
				</div>
			</div>
				
			<!-- WIRKT Review -->	
			
	 		<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_wirkt.jpg" alt="WIRKT!" width="60"></img>
	 				<div class="pt-2">
	 					<div class="rating">
							<input id="star1_wirkt" type="radio" name="wirkt_score" value="5">
							<label for="star1_wirkt"></label>
							<input id="star2_wirkt" type="radio" name="wirkt_score" value="4">
							<label for="star2_wirkt"></label>
							<input id="star3_wirkt" type="radio" name="wirkt_score" value="3">
							<label for="star3_wirkt"></label>
							<input id="star4_wirkt" type="radio" name="wirkt_score" value="2">
							<label for="star4_wirkt"></label>
							<input id="star5_wirkt" type="radio" name="wirkt_score" value="1">
							<label for="star5_wirkt"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row mt-3">
			<div class="col">
			<textarea class="form-control" name="review_comment" id="review_comment" rows="3" placeholder="Was hat Dir gefallen oder nicht? Wofür hast Du gelernt?"></textarea>	
				<input type="hidden" name="review_unit_id" value="0"/>
				<input type="hidden" name="review_content_id" value="{{$content->id}}"/>
			</div>
		</div>	
		<div class="row">
			<div class="col">
				<button class="mt-3" type="submit">Bewerten</button>
			</div>
		</div>
	</form>
</div>


<!-- Inhalt Modal "Fehler melden" -->
<div class="modal fade" id="fehlerModal" tabindex="-1" role="dialog" aria-labelledby="fehlerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Fehler für {{$content->content_title}} melden</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			@include('layouts.errors')
			<form action="/mistakes" method="POST">
			{{ csrf_field() }}
				<div class="modal-body">
					<select class="mb-3 form-control" id="type" name="type">
						<option value="">Bitte Art des Fehlers auswählen</option>
						<option>Technischer Fehler</option>
						<option>Inhaltsfehler</option>
					</select>
					<textarea class="form-control" id="mistake_description" name="mistake_description" placeholder="Beschreibe den Fehler etwas genauer: an welcher Stelle ist der Fehler? Was wäre richtig? Wenn es sich um eintechnisches Problem handelt, welches Endgerät/Browser hast Du benutzt?">{{old('mistake_description')}}</textarea>
					<input id="mistake_content_id" name="mistake_content_id" type="hidden" value="{{$content->id}}" />
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn-sm btn-primary">Fehler senden</button>
				</div>
			</form>
		</div>
	</div>
</div>
<hr></hr>

@if($question != null) 
<!-- Inhalt Modal "Teste Dich selbst!" -->
<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Testfrage für {{$content->content_title}}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="bg-secondary p-2 text-white">
					<p>{{$question->question}}</p>
					<small>
						@if ($correctAnswers > 1) 
						(mehrere Antworten sind richtig)
						@else
						(eine Antwort ist richtig)
						@endif
					</small>
				</div>
				<ul class="list-group">
					@isset($question->answer1)
					<li class="list-group-item">
						<div class="d-flex justify-content-start align-items-center">
							<input type="checkbox" id="guess1" name="guess1"/>
							<span class="ml-3">{{$question->answer1}}</span>
							<span id="correct1" class="ml-auto"></span>
						</div>
					</li>
					@endisset
					@isset($question->answer2)
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess2" name="guess2"/>
							<span class="ml-3">{{$question->answer2}}</span>
							<span id="correct2" class="ml-auto"></span>
						</div>
					</li>
					@endisset
					@isset($question->answer3)
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess3" name="guess3"/>
							<span class="ml-3">{{$question->answer3}}</span>
							<span id="correct3" class="ml-auto"></span>
						</div>
					</li>
					@endisset
					@isset($question->answer4)
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess4" name="guess4"/>
							<span class="ml-3">{{$question->answer4}}</span>
							<span id="correct4" class="ml-auto"></span>
						</div>
					</li>
					@endisset
					@isset($question->answer5)
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess5" name="guess5"/>
							<span class="ml-3">{{$question->answer5}}</span>
							<span id="correct5" class="ml-auto"></span>
						</div>
					</li>
					@endisset
				</ul>
			</div>
				<div class="modal-footer d-flex justify-content-between">
					<p id="correct"></p>
					
					<button class="btn btn-primary ml-auto" onclick="myResultFunction()">Lösung prüfen</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif

<div class="container">
	<div class="row">
		<div class="col-4 pt-5">
			<p>Verwandte Artikel:</p>
		</div>
		<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
		</div>
 		<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
			</div>
			<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
			</div>
		</div>  
	</div>
</div>


<hr></hr>
<div class="container">
<h3>Vorhandene Bewertungen</h3>
</div>


@endsection
	
@section('scripts')


@if(count($errors))
<script>
$(function() {
    $("#fehlerModal").modal();
});
</script>
@endif


<script>
$(document).ready(function(){
    $("#open").click(function(){
        $("#fehlerModal").modal();
    });
});</script>

@if($question != null)
<script>
$(document).ready(function(){
    $("#question").click(function(){
        $("#testModal").modal();
    });
});</script>

<script>
function myResultFunction() {
	var addPoint = 0;
	var finalResult = {!! json_encode($finalResult) !!};
    
    var sol1 = document.getElementById("guess1");
    if (sol1 != null) {
    	var solution1 = {!! json_encode($question->solution1) !!};
    	var sol1 = document.getElementById("guess1").checked;
    	if (sol1 == true) {
    		if (solution1 == 1) {
    			addPoint ++;
    			document.getElementById("correct1").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct1").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution1 == 0) {
				addPoint ++;
				document.getElementById("correct1").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct1").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}

    var sol2 = document.getElementById("guess2");
    if (sol2 != null) {
    	var solution2 = {!! json_encode($question->solution2) !!};
    	var sol2 = document.getElementById("guess2").checked;
    	if (sol2 == true) {
			if (solution2 == 1) {
    			addPoint ++;
    			document.getElementById("correct2").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct2").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution2 == 0) {
				addPoint ++;
				document.getElementById("correct2").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct2").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}

    var sol3 = document.getElementById("guess3");
    if (sol3 != null) {
    	var solution3 = {!! json_encode($question->solution3) !!};
    	var sol3 = document.getElementById("guess3").checked;
    	if (sol3 == true) {
			if (solution3 == 1) {
    			addPoint ++;
    			document.getElementById("correct3").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct3").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution3 == 0) {
				addPoint ++;
				document.getElementById("correct3").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct3").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}
    
    var sol4 = document.getElementById("guess4");
    if (sol4 != null) {
    	var solution4 = {!! json_encode($question->solution4) !!};
    	var sol4 = document.getElementById("guess4").checked;
    	if (sol4 == true) {
			if (solution4 == 1) {
    			addPoint ++;
    			document.getElementById("correct4").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
				document.getElementById("correct4").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution4 == 0) {
				addPoint ++;
				document.getElementById("correct4").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct4").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
    }
    
    var sol5 = document.getElementById("guess5");
    if (sol5 != null) {
    	var solution5 = {!! json_encode($question->solution5) !!};
    	var sol5 = document.getElementById("guess5").checked;
    	if (sol5 == true) {
			if (solution5 == 1) {
    			addPoint ++;
    			document.getElementById("correct5").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct5").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution5 == 0) {
				addPoint ++;
				document.getElementById("correct5").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct5").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
    }
    
    if (addPoint == finalResult) {
    document.getElementById("correct").innerHTML = "Richtig";
	}
	else {
    document.getElementById("correct").innerHTML = "Falsch";
	}
}

</script>
@endif

@endsection

