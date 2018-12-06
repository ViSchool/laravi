@extends('layout_teacher')
		
@section ('page-header')

<div class="m-0 d-none d-sm-block">
	<div class="d-flex justify-content-between align-items-center" style="background-image:url(/images/banner_small.jpeg); height:180px;">
		<div class="d-flex flex-column" style="max-width: 600px;">
			<h3 class="text-brand-yellow p-5 mb-auto">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung?</h3>
			<a class="mt-auto m-5 btn btn-light text-brand-blue" href="#">Jetzt Lehrerzugang erstellen und sofort starten!</a>
		</div>
		<img class="img-fluid m-5" src="/images/vischool_ipad.png" style="height:60%; transform: rotate(15deg);";"></img>
	</div>
</div>

@include('teacher.teacher_components.loggedInTeacher')

@endsection
		
@section ('content')

<div class="container my-5">
	
	<h2 class="text-brand-red">Macht Eure Schule digitaler</h2>
	Unser Beratungsangebot reicht von Workshops zu einzelnen Tools über einen pädagogischen Ganztag bis hin zu einer längeren Begleitung. Unsere Workshops zu einzelnen Tools dauern etwa 2h und sind für bis zu 20 Teilnehmer gedacht. In Bonn und Umgebung können wir diese kostenlos anbieten. 
	Für weitergehende Beratung erstellen wir Euch gern ein individuelles Angebot. Für einen pädagogischen Ganztag solltet Ihr mit Kosten von etwa 800 Euro plus ggf. Reisekosten (entfällt in Bonn und Umgebung). 
</div>

@endsection
