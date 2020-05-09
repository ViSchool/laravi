<!-- Navigation -->

{{-- <div class="container">
	{{$browser}}
</div> --}}
<nav class="navbar navbar-expand-md navbar-light flex-column align-items-start mb-3 shadow-sm">
	
	<div id="vischool_nav" class="w-100 d-flex justify-content-between">
		<button class="navbar-toggler m-0 p-0 border-0" type="button" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="navbar-toggler-icon"></span>
      </button>  
		<!-- Brand -->
		<a class="navbar-brand" href="/">ViSchool</a>
		<!-- Suche -->
		<div class="d-none d-md-block mt-2">
			<form action="/suche" enctype="multipart/form-data">
			@csrf
   			<input type="search" class="form-control mx-4" placeholder="&#xf002    Themen, Inhalte und Lerneinheiten suchen" name="search" style="width:50vw; font-size:12px;">	
				<button class="btn btn-link" type="submit"></i></button>
			</form>
		</div>
		<!-- User Button  -->
		<div id="userLoggedButton" class="mr-4 d-none d-md-block">
			<div class="dropdown mr-1">
    			<a class="btn btn-link box-shadow:none" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,80">
					<span class="fa-stack" style="vertical-align: top; color:gray">
						<i class="far fa-circle fa-stack-2x"></i>
						<i class="fas fa-user fa-stack-1x"></i>
					</span>
					@guest ('web')
						@guest('student')
							<p><small class="text-secondary">Login</small></p>
						@else
							<p><small class="text-secondary">{{Auth::guard('student')->user()->student_name}}</small></p>
						@endguest
					@else
						<p><small class="text-secondary">{{Auth::user()->teacher_name}}</small></p>
					@endguest
					
				</a>
				<div class="dropdown-menu dropdown-menu-right border-0 shadow" aria-labelledby="dropdownMenuOffset" style="max-width: 200px;">
					@auth ('web')
						<a href="/lehrer/logout" class="btn-sm btn-primary text-white ml-1"> <i class="fas fa-sign-out-alt"></i> Logout</a>
					@endauth
					@auth('student')
						<a class="dropdown-item pl-2" href="/schueler/auftraege" ><small>Aufträge</small> </a>
						<div class="dropdown-divider"></div>
						<a href="/schueler/logout" class="btn-sm btn-primary text-center btn-block text-white"> <i class="fas fa-sign-out-alt"></i> Logout</a>
					@endauth
					@guest ('web')
						@guest('student')						
						<p class="ml-4"><small>Du bist nicht eingeloggt.</small></p>
						<p><a href="/login" class="btn-sm btn-primary text-white ml-4"> <i class="fas fa-sign-in-alt"></i> Lehrer-Login</a></p>
						<p><a href="/schueler/anmelden" class="btn-sm btn-primary text-white ml-4"> <i class="fas fa-sign-in-alt"></i> Schüler-Login</a></p>
						<p><a href="/register" class="btn-sm btn-link ml-3">Als Lehrer registrieren</a></p>
						@endguest
					@endguest
    			</div>
			</div>	
		</div>
	</div>

	<div class="w-100 d-md-none">
		<form action="/suche" enctype="multipart/form-data">
			@csrf
				<div class="search d-flex px-5 justify-content-center">
   				<input type="search" class="form-control mx-2" placeholder="&#xf002     Inhalte und mehr suchen" name="search">	
					<button class="d-none" type="submit"></button>
				</div>
			</form>
	</div>

   <div class="collapse navbar-collapse">
        	<ul class="navbar-nav">
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
						
						@guest ('web')
							@auth('student')
								<a class="btn btn-primary w-100 text-left disabled" href="/login">Anmelden</a>
							@else 
								<a class="btn btn-primary w-100 text-left" href="/login">Anmelden</a>
							@endauth
							
							<a class="dropdown-item" href="/register">Als Lehrer registrieren</a>
							<a class="dropdown-item" href="/lehrer">Angebote für Lehrer</a>
						@endguest
						@auth('web')
							<a class="btn btn-primary dropdown-item" href="/lehrer/logout">Logout</a>	
						@endauth
						<div class="dropdown-divider"></div>
						@auth ('web')
							<a class="dropdown-item" href="/lehrer/lehrerkonto">Mein Lehrerkonto</a>
						@else
							<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Mein Lehrerkonto</a>
						@endauth
						@auth('web')
							<a class="dropdown-item" href="/lehrer/themen">Meine Themen</a>
							<a class="dropdown-item" href="/lehrer/inhalte">Meine Inhalte</a>
							<a class="dropdown-item" href="/lehrer/lerneinheiten">Meine Lerneinheiten</a>					
						@else
							<a class="dropdown-item disabled" href="http://">Meine Themen</a>
							<a class="dropdown-item disabled" href="http://">Meine Inhalte</a>
							<a class="dropdown-item disabled" href="http://">Meine Lerneinheiten</a>
						@endauth
						@auth('web')
							<a class="dropdown-item" href="/lehrer/schueleraccounts">Meine Schüler</a>
							{{-- <a class="dropdown-item" href="/lehrer/auftraege">Meine Aufträge</a> --}}
						@else
							<a class="dropdown-item disabled" href="">Meine Schüler</a>
							{{-- <a class="dropdown-item disabled" href="">Meine Aufträge</a> --}}
						@endauth
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownStudent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Schüler</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownStudent">
						@guest ('student')
							@auth('web')
								<a class="btn btn-primary w-100 text-left disabled" href="/schueler/anmelden">Anmelden</a>
							@else 
								<a class="btn btn-primary w-100 text-left" href="/schueler/anmelden">Anmelden</a>
								<a class="dropdown-item disabled" href="#" > Dein Aufträge</a>
							@endauth
						@endguest
						@auth('student')
							<a class="btn btn-primary dropdown-item" href="/schueler/logout">Logout</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="/schueler/auftraege" > Dein Aufträge</a>

						@endauth
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/portalnavigator">Portalnavigator</a>					
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownHilfe" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hilfe</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownHilfe">
						<a class="dropdown-item" href="/support">Wir helfen Dir</a>
						<a class="dropdown-item" href="/faq">FAQs</a>
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
			</ul>
</nav>



