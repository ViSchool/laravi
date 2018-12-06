<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<a class="nav-link" href="/backend">Übersicht <span class="sr-only"></span></a>
		</li>
	</ul>

	<ul class="nav nav-pills flex-column">
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
		<a class="nav-link" href="/backend/units">Unterrichtseinheiten</a>
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
	</ul>
				
	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<a class="nav-link" href="/backend/blog"><i class="far fa-edit"></i> Blog</a>
		</li>
		
		<li class="nav-item">
			 <a class="nav-link" href="{{route('admin.logout')}}"><i class="far fa-sign-out-alt"></i> Logout</a>
  		</li>
  		<li class="nav-item">
			 <a class="nav-link" href="{{route('vischool')}}"><i class="far fa-home"></i> ViSchool</a>
  		</li>
	</ul>
</nav>
