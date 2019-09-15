<!-- Navigation -->

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="#">Fixed navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

{{--<div id="vischool_nav">
	<nav class="navbar navbar-expand-md fixed-top navbar-light">	
		<a class="navbar-brand" href="/">ViSchool</a>
		<form action="/suche" enctype="multipart/form-data">
			@csrf
   			<input type="search" class="form-control" placeholder="Suche" name="search">	
			<button class="d-none" type="submit"></button>
		</form>

	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
				
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFaecher" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fächer</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownSubjects">
					@foreach($subjects as $subject)
						<a class="dropdown-item" href="/subjects/{{$subject->id}}">{{$subject->subject_title}}</a>
					@endforeach
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLehrer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lehrer</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownLehrer">
					@guest
					<a class="btn-sm btn-primary dropdown-item" href="/login">Anmelden</a>
					<a class="dropdown-item" href="/lehrer/register_soon">Als Lehrer registrieren</a>
					<a class="dropdown-item" href="/lehrer">Angebote für Lehrer</a>
					@endguest
					@auth
					<a class="btn-sm btn-primary dropdown-item" href="/lehrer/logout">Logout</a>	
					@endauth
					<div class="dropdown-divider"></div>
					@hasanyrole('Lehrer (free)|Lehrer (premium)')
					<a class="dropdown-item" href="/lehrer/lehrerkonto">Mein Lehrerkonto</a>
					@else
					<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Mein Lehrerkonto</a>
					@endhasanyrole
					@hasanyrole('Lehrer (free)|Lehrer (premium)|Schüler')
					<a class="dropdown-item" href="/lehrer/themen">Meine Themen</a>
					<a class="dropdown-item" href="/lehrer/inhalte">Meine Inhalte</a>
					<a class="dropdown-item" href="/lehrer/unterrichtseinheiten">Meine Unterrichtseinheiten</a>
					@else
					<a class="dropdown-item disabled" href="http://">Meine Themen</a>
					<a class="dropdown-item disabled" href="http://">Meine Inhalte</a>
					<a class="dropdown-item disabled" href="http://">Meine Unterrichtseinheiten</a>
					@endhasanyrole
					@hasanyrole('Lehrer (free)|Lehrer (premium)')
					<a class="dropdown-item" href="/lehrer/accounts">Schüler und Klassen einrichten</a>
					@else
					<a class="dropdown-item disabled" href="http://">Schüler und Klassen einrichten</a>
					@endhasanyrole
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownStudent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Schüler</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownStudent">
					@if (Auth::guard('student')->check())
					<p class="dropdown-item text-success">Du bist eingeloggt als {{Auth::guard('student')->user()->student_name}} 
						@if(Auth::guard('student')->user()->class_account == 1) 
							(Klasse)
						@else 
							(Schüler) 
						@endif</p>
					<a class="dropdown-item text-info" href="/schueler/logout">Logout</a>	 
					@else
						@include('layouts.errors')	
						<form action="/schueler/login" method="post" class="p-4 m-3 border-1">
							@csrf	
							<div class="form-group">
								<label for="student_name">Benutzername</label>
								<input type="text" class="form-control" id="student_name" name="student_name">
							</div>
							<div class="form-group">
								<label for="password">Passwort</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Passwort">
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary">Einloggen</button>
							</div>
						</form>
					@endif		
				</div>
				
			</li>

			<li class="nav-item">
				<a class="nav-link" href="/blog">Blog</a>					
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRechtliches" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rechtliches</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownRechtliches">
						<a class="dropdown-item" href="/impressum">Impressum</a>
						<a class="dropdown-item" href="/datenschutz">Datenschutz</a>
					</div>	
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/backend/">Admin</a>				
			</li>
     	</ul>
	</nav>
</div>--}}



