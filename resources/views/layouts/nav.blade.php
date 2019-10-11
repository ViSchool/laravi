<!-- Navigation -->
<div id="vischool_nav">
	<nav class="navbar navbar-expand-md fixed-top navbar-light">	
		<!-- Brand -->
		<a class="navbar-brand" href="/">ViSchool</a>
		<!-- Suche -->
		<form action="/suche" enctype="multipart/form-data">
			@csrf
   			<input type="search" class="form-control" placeholder="Suche" name="search">	
			<button class="d-none" type="submit"></button>
		</form>
		<!-- Toggler on small displays -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
				
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link mx-2" href="/">Startseite <span class="sr-only">(current)</span></a>
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
					<a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownLehrer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lehrer</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownLehrer">
						@guest
							<a class="btn-sm btn-primary dropdown-item" href="/login">Anmelden</a>
							<a class="dropdown-item" href="/lehrer/register_soon">Als Lehrer registrieren</a>
							<a class="dropdown-item" href="/lehrer">Angebote für Lehrer</a>
						@endguest
						@auth
							<a class="btn-sm btn-primary dropdown-item" href="/lehrer/logout">Logout</a>	
						@endauth
						<div class="dropdown-divider">
						</div>
						@hasanyrole('Lehrer (free)|Lehrer (premium)')
							<a class="dropdown-item" href="/lehrer/lehrerkonto">Mein Lehrerkonto</a>
						@else
							<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Mein Lehrerkonto</a>
						@endhasanyrole
						@hasanyrole('Lehrer (free)|Lehrer (premium)|Schüler')
							<a class="dropdown-item" href="/lehrer/themen">Meine Themen</a>
							<a class="dropdown-item" href="/lehrer/inhalte">Meine Inhalte</a>
							<a class="dropdown-item" href="/lehrer/unterrichtseinheiten">Meine Lerneinheiten</a>
						@else
							<a class="dropdown-item disabled" href="http://">Meine Themen</a>
							<a class="dropdown-item disabled" href="http://">Meine Inhalte</a>
							<a class="dropdown-item disabled" href="http://">Meine Lerneinheiten</a>
						@endhasanyrole
						@hasanyrole('Lehrer (free)|Lehrer (premium)')
							<a class="dropdown-item" href="/lehrer/klassenaccounts">Meine Klassenaccounts</a>
						@else
							<a class="dropdown-item disabled" href="">Meine Klassenaccounts</a>
						@endhasanyrole
						@hasanyrole('Lehrer (free)|Lehrer (premium)')
							<a class="dropdown-item" href="/lehrer/schueleraccounts">Meine Schüleraccounts</a>
						@else
							<a class="dropdown-item disabled" href="">Meine Schüleraccounts</a>
						@endhasanyrole
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownStudent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Schüler</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownStudent">
						@if (Auth::guard('student')->check())
							<p class="dropdown-item text-success">Du bist eingeloggt als {{Auth::guard('student')->user()->student_name}} 
								@if(Auth::guard('student')->user()->class_account == 1) 
									(Klasse)
								@else 
									(Schüler) 
								@endif
							</p>
							<a class="dropdown-item text-info" href="/schueler/logout">Logout</a>	 
						@else
						
							<!-- Schülerlogin -->
							@include('layouts.errors')	
							<form action="/schueler/login" method="post" class="p-4 m-3" style="min-width: 200px;">
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
									<button type="submit" class="btn-sm btn-primary">Einloggen</button>
								</div>
							</form>
						@endif		
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link mx-2" href="/blog">Blog</a>					
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownRechtliches" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rechtliches</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownRechtliches">
						<a class="dropdown-item" href="/impressum">Impressum</a>
						<a class="dropdown-item" href="/datenschutz">Datenschutz</a>
					</div>	
				</li>


				@auth
				<li class="nav-item dropdown ml-5">
					<div class="mt-2 btn-group dropleft">
						<a class="btn btn-outline-success nav-link dropdown-toggle" href="#" id="navbarDropdownLoggedIn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class=" fas fa-user-graduate"></i></a>
					
						<div class="dropdown-menu" aria-labelledby="navbarDropdownLoggedIn">
							<small>Lehreraccount: <span class="text-brand-blue">{{Auth::user()->teacher_name}}</span></small>
							<a class="btn btn-warning dropdown-item" href="lehrer/logout">Logout</a>
						</div>
					</div>
				</li>
				@endauth

				@if (Auth::guard('student')->check())
				<li class="nav-item dropdown ml-5">
					<div class="mt-2 btn-group dropleft">
						<a class="btn btn-outline-success nav-link dropdown-toggle" href="#" id="navbarDropdownLoggedIn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class=" fas fa-user"></i></a>
					
						<div class="dropdown-menu" aria-labelledby="navbarDropdownLoggedIn">
							<small>
								@if (Auth::guard('student')->user()->class_account == 1)
								Klassenaccount: <span class="text-brand-red">{{Auth::guard('student')->user()->student_name}}</span>
								@else
								Schüleraccount: <span class="text-brand-red">{{Auth::guard('student')->user()->student_name}}</span>
								@endif
							</small>
							<a class="btn btn-warning dropdown-item" href="/schueler/logout">Logout</a>
						</div>
					</div>
				</li>
				@endif

			</ul>
		</div>  
	</nav>
</div>



