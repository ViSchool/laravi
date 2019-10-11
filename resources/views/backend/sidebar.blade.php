<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<a class="nav-link" href="/backend">Übersicht <span class="sr-only"></span></a>
		</li>
	</ul>

	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			@php
				 $status = App\Status::find(2);
				 $nrApprovals= count($status->contents) + count($status->units) + count($status->topics) + count($status->series);
			@endphp
			<a class="nav-link" href="/backend/freigaben">Freigaben @if ($nrApprovals > 0) <sup class="badge badge-pill badge-danger">{{$nrApprovals}}</sup> @endif</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/subjects">Fächer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/topics">Themen</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/contents">Inhalte</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/units">Lerneinheiten</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/series">Serien</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/portals">Lernportale</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/tools">Tool-Datenbank</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/tags">Tags</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/schools">Schulen</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/teacher">Lehrer</a>
		</li>
	</ul>
				
	<ul class="nav nav-pills flex-column">
		{{-- <li class="nav-item">
			<a class="nav-link" href="/backend/permissions"><i class="fas fa-users"></i><small> Benutzerverwaltung</small> </a>
		</li> --}}
		
		<li class="nav-item">
			<a class="nav-link" href="/backend/blog"><i class="far fa-edit"></i> Blog</a>
		</li>
		
		<li class="nav-item">
			 <a class="nav-link" href="{{route('admin.logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
  		</li>
  		<li class="nav-item">
			 <a class="nav-link" href="{{route('vischool')}}"><i class="fas fa-home"></i> ViSchool</a>
  		</li>
	</ul>
</nav>
