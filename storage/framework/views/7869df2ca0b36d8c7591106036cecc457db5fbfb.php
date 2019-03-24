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
	<li class="nav-item">
			<a class="nav-link" href="/backend/schools">Schulen</a>
	</li>
	<li class="nav-item">
			<a class="nav-link" href="/backend/teacher">Lehrer</a>
	</li>
	</ul>
				
	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<a class="nav-link" href="/backend/permissions"><i class="fas fa-users"></i><small> Benutzerverwaltung</small> </a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link" href="/backend/blog"><i class="far fa-edit"></i> Blog</a>
		</li>
		
		<li class="nav-item">
			 <a class="nav-link" href="<?php echo e(route('admin.logout')); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
  		</li>
  		<li class="nav-item">
			 <a class="nav-link" href="<?php echo e(route('vischool')); ?>"><i class="fas fa-home"></i> ViSchool</a>
  		</li>
	</ul>
</nav>
