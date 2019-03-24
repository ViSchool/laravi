<!-- Navigation -->
<div id="vischool_nav">
	<nav class="navbar navbar-expand-md fixed-top navbar-light">	
		<a class="navbar-brand" href="/">ViSchool</a>
		<form action="/suche" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
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
					<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="dropdown-item" href="/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLehrer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lehrer</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownLehrer">
					<?php if(auth()->guard()->guest()): ?>
					<a class="btn-sm btn-primary dropdown-item" href="/login">Anmelden</a>
					<a class="dropdown-item" href="/register">Als Lehrer registrieren</a>
					<a class="dropdown-item" href="/lehrer">Angebote für Lehrer</a>
					<?php endif; ?>
					<?php if(auth()->guard()->check()): ?>
					<a class="btn-sm btn-primary dropdown-item" href="/lehrer/logout">Logout</a>	
					<?php endif; ?>
					<div class="dropdown-divider"></div>
					<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
					<a class="dropdown-item" href="/lehrer/lehrerkonto">Mein Lehrerkonto</a>
					<?php else: ?>
					<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Mein Lehrerkonto</a>
					<?php endif; ?>
					<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)|Schüler')): ?>
					<a class="dropdown-item" href="/lehrer/themen">Meine Themen</a>
					<a class="dropdown-item" href="/lehrer/inhalte">Meine Inhalte</a>
					<a class="dropdown-item" href="/lehrer/unterrichtseinheiten">Meine Unterrichtseinheiten</a>
					<?php else: ?>
					<a class="dropdown-item disabled" href="http://">Meine Themen</a>
					<a class="dropdown-item disabled" href="http://">Meine Inhalte</a>
					<a class="dropdown-item disabled" href="http://">Meine Unterrichtseinheiten</a>
					<?php endif; ?>
					<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
					<a class="dropdown-item" href="http://">Schüler und Klassen einrichten</a>
					<?php else: ?>
					<a class="dropdown-item disabled" href="http://">Schüler und Klassen einrichten</a>
					<?php endif; ?>
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
</div>



