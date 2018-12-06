<!-- Navigation -->
 <div id="vischool_nav">
	<nav class="navbar navbar-expand-md fixed-top navbar-light">
		<a class="navbar-brand d-none d-sm-block" href="http://dev.instant-digitization.de">ViSchool</a>
			<button type="button" class="btn btn-link ml-auto p-2 mt-2"  data-toggle="collapse" data-target="#searchbox" aria-expanded="false" aria-controls="searchbox"><i class="fas fa-search"></i></button>
			<div id="searchbox" class="collapse">
			<form class="form-inline">
				<input class="form-control" type="search" placeholder="Suche" aria-label="Suche">	
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit"></button>
			</form>
		</div>
		
			
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fächer</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						@foreach($subjects as $subject)
						<a class="dropdown-item" href="/subjects/{{$subject->id}}">{{$subject->subject_title}}</a>
						@endforeach
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/lehrer">Lehrer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Impressum</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/backend/">Admin</a>
				</li>
     		</ul>
		</div>
		
	</nav>
</div>

