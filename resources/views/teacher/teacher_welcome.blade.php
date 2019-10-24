@extends('layout')

@section('stylesheets')
@endsection

@section ('page-header')

<section class="jumbotron p-2 mb-5">	
	<div class="container-fluid" style="background-image:url(/images/banner_small.jpeg);">
			<div class="row ml-5">
				<div class="col-8">
					<h1 class="mt-3 text-info">ViSchool für Lehrer</h1>
					<h3 class="lead text-white">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung? Starte mit fertigen Unterrichtseinheiten oder lass Dich von uns <a href="#coaching">kostenlos</a> zu Deinen eigenen Unterrichtsideen beraten.</h3>
					<p class="text-center">
						<a href="/lehrer/register_soon" class="btn btn-primary my-2">Als Lehrer bei ViSchool anmelden</a>
					</p>
					</div>
					
					<div class="col d-flex justify-content-end">
					<div class="d-none d-sm-block">	
						<img class="img-fluid mt-5" src="/images/vischool_ipad.png" style="max-height:120px; transform: rotate(15deg);"></img>
					</div>
					</div>
			</div>
			
    </div>
  </section>
@endsection
		
@section ('content')
@if(session('message'))
<div class="alert alert-success" role="alert">
  {{ session('message') }}
</div>
@endif


<div class="container my-5">
	<h2 class="text-brand-blue">Nutze fertige Unterrichtseinheiten zu vielen Themen</h2>
	<p>Nutze die Unterrichtseinheiten, die von Lehrern bereits im Unterricht eingesetzt und erprobt wurden. Sie sind kostenlos und können sofort auch ohne Anmeldung eingesetzt werden. Willst Du die Einheiten nach Deinen Vorstellungen anpassen, musst Du Dir <a href="#">hier</a> einen ViSchool-Lehrerzugang erstellen. </p>
	

<div class="d-flex justify-content-center my-5">
<div class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" >
		{{-- erste drei Karten --}}
		<div class="carousel-item active bg-white" style="height:100%">
			<div class="card-deck">
				@foreach ($unitsSet01 as $unit)
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							@isset($unit->unit_img)
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/{{$unit->unit_img}}" alt="Lerneinheiten01">	
							@endisset 
							@empty($unit->unit_img)
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							@endempty
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		{{-- Ende erste drei Karten --}}

		@if (count($unitsSet02)!= 0)
		{{-- zweite drei Karten --}}
		<div class="carousel-item bg-white" style="height:100%">
			<div class="card-deck">
				@foreach ($unitsSet02 as $unit)
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							@isset($unit->unit_img)
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/{{$unit->unit_img}}" alt="Lerneinheiten01">	
							@endisset 
							@empty($unit->unit_img)
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							@endempty
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		{{-- Ende zweite drei Karten --}}
		@endif

		@if (count($unitsSet03)!= 0)
		{{-- zweite drei Karten --}}
		<div class="carousel-item bg-white" style="height:100%">
			<div class="card-deck">
				@foreach ($unitsSet03 as $unit)
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							@isset($unit->unit_img)
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/{{$unit->unit_img}}" alt="Lerneinheiten01">	
							@endisset 
							@empty($unit->unit_img)
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							@endempty
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/{{$unit->id}}">{{$unit->unit_title}}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		{{-- Ende zweite drei Karten --}}
		@endif

	</div>
</div>
</div>


	<div class="d-flex justify-content-center mb-3">
	<a href="/lehrer/units">Zu den fertigen Unterrichtseinheiten für alle Fächern</a>
	</div>
	<hr></hr>

	<h2 class="text-brand-red">Erweitere Deinen Unterricht mit digitalen Tools und Inhalten</h2>
	<img class="img-fluid mb-3" src="/images/unit_example.jpeg"></img>
	<p>Du kannst selbst Unterrichtseinheiten auf Basis aller bei uns hinterlegten Inhalte erstellen. Alles digital? Nein, unsere Unterrichtseinheiten können sowohl ganz klassische Unterrichtselemente enthalten, als auch digitale, wie Videos, Quizzes und Onlineaufgaben. Fehlt Dir ein Inhalt, dann kannst Du ihn selbst hinzufügen. Melde Dich an, um diese Funktionen zu nutzen.</p>
	
	{{-- <hr></hr>
	<h2 class="text-brand-blue">Lerne Tools kennen</h2>
	<p>Es gibt zahlreiche kostenlos nutzbare Tools, die Du für Deinen Unterricht nutzen kannst. Wie Du sie anwendest, erklären wir Dir hier. </p>
		<hr></hr>
	<h2 class="text-brand-red">Unser Bewertungssystem</h2>
	<div class="row">
		<div class="col">
		<img class="img-fluid" src="/images/logo_aha.jpg"></img>
		</div>
		<div class="col">
		<img class="img-fluid" src="/images/logo_cool.jpg"></img>
		</div>
		<div class="col">
		<img class="img-fluid" src="/images/logo_wirkt.jpg"></img>
		</div>
	</div> --}}
	
	<hr></hr>
	<h2 class="text-brand-blue">Coaching für Lehrer und Schulen</h2>
	<div id="coaching" class="card-deck">
		<div class="card">
			<a href="/lehrer/coaching"><img class="card-img-top" src="/images/schueler_laptop.jpg" alt="Card image cap"></a>
			<div class="card-body">
				<h4 class="card-title text-brand-red">Für Lehrer</h4>
				<p class="card-text">Du fühlst Dich noch nicht sicher genug, selbst komplette Unterrichtseinheiten zu erstellen? Kein Problem, wir coachen Dich. <a href="/lehrer/coaching">Hier</a> findest Du weitere Informationen.</p>
			</div>
		</div>
		<div class="card">
			<a href="/lehrer/schulcoaching"><img class="card-img-top" src="/images/schulflur.jpg" alt="Card image cap"></a>
			<div class="card-body">
				<h4 class="card-title text-brand-red">Für Schulen</h4>
      			<p class="card-text">Ihr wollt Eure Schule komplett fit machen für digitalen Unterricht? Wir gestalten mit Euch einen zum Beispiel einen Pädagogischen Ganztag zum Thema Digitalisierung. Mehr Infos dazu findet Ihr <a href="/lehrer/schulcoaching">hier</a>.</p>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
@endsection