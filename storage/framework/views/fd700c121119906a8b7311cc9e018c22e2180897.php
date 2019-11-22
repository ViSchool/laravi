<!-- Navigation -->


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
			<?php echo csrf_field(); ?>
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
					<p><small class="text-secondary">Dein Lehrer Zugang</small></p> 
				</a>
				<div class="dropdown-menu border-0 shadow mr-2" aria-labelledby="dropdownMenuOffset" style="max-width: 200px;">
					<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
						<p><small >Du bist eingeloggt als <?php echo e(Auth::user()->teacher_name); ?> (Lehrer)</small></p>
						<a href="/lehrer/logout" class="btn-sm btn-primary text-white ml-1"> <i class="fas fa-sign-out-alt"></i> Logout</a>
					<?php endif; ?>
					<?php if(auth()->check() && auth()->user()->hasAnyRole('Schüler')): ?>
						<p><small>Du bist eingeloggt als <?php echo e(Auth::guard('student')->user()->student_name); ?> 
								<?php if(Auth::guard('student')->user()->class_account == 1): ?> 
									(Klasse)
								<?php else: ?> 
									(Schüler) 
								<?php endif; ?>
							</small></p>
						<a href="/schueler/logout" class="btn-sm btn-primary text-white ml-1"> <i class="fas fa-sign-out-alt"></i> Logout</a>
					<?php endif; ?>
					<?php if(auth()->guard()->guest()): ?>
						<p class="ml-4"><small>Du bist nicht eingeloggt.</small></p>
						<p><a href="/login" class="btn-sm btn-primary text-white ml-4"> <i class="fas fa-sign-in-alt"></i> Lehrer-Login</a></p>
						
						<p><a href="/register" class="btn-sm btn-link ml-3">Registrieren</a></p>
					<?php endif; ?>
    			</div>
			</div>	
		</div>
	</div>

	<div class="w-100 d-md-none">
		<form action="/suche" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
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
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a class="dropdown-item" href="/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLehrer" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lehrer</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownLehrer">
						<?php if(auth()->guard()->guest()): ?>
							<a class="btn btn-primary w-100 text-left" href="/login">Anmelden</a>
							<a class="dropdown-item" href="/register">Als Lehrer registrieren</a>
							<a class="dropdown-item" href="/lehrer">Angebote für Lehrer</a>
						<?php endif; ?>
						<?php if(auth()->guard()->check()): ?>
							<a class="btn btn-primary dropdown-item" href="/lehrer/logout">Logout</a>	
						<?php endif; ?>
						<div class="dropdown-divider">
						</div>
						<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
							<a class="dropdown-item" href="/lehrer/lehrerkonto">Mein Lehrerkonto</a>
						<?php else: ?>
							<a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Mein Lehrerkonto</a>
						<?php endif; ?>
						<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)|Schüler')): ?>
							<a class="dropdown-item" href="/lehrer/themen">Meine Themen</a>
							<a class="dropdown-item" href="/lehrer/inhalte">Meine Inhalte</a>
							<a class="dropdown-item" href="/lehrer/lerneinheiten">Meine Lerneinheiten</a>
						<?php else: ?>
							<a class="dropdown-item disabled" href="http://">Meine Themen</a>
							<a class="dropdown-item disabled" href="http://">Meine Inhalte</a>
							<a class="dropdown-item disabled" href="http://">Meine Lerneinheiten</a>
						<?php endif; ?>
						<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
							<a class="dropdown-item" href="/lehrer/klassenaccounts">Meine Klassenaccounts</a>
						<?php else: ?>
							<a class="dropdown-item disabled" href="">Meine Klassenaccounts</a>
						<?php endif; ?>
						<?php if(auth()->check() && auth()->user()->hasAnyRole('Lehrer (free)|Lehrer (premium)')): ?>
							<a class="dropdown-item" href="/lehrer/schueleraccounts">Meine Schüleraccounts</a>
						<?php else: ?>
							<a class="dropdown-item disabled" href="">Meine Schüleraccounts</a>
						<?php endif; ?>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownStudent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Schüler</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownStudent">
						<?php if(Auth::guard('student')->check()): ?>
							<p class="dropdown-item text-success">Du bist eingeloggt als <?php echo e(Auth::guard('student')->user()->student_name); ?> 
								<?php if(Auth::guard('student')->user()->class_account == 1): ?> 
									(Klasse)
								<?php else: ?> 
									(Schüler) 
								<?php endif; ?>
							</p>
							<a class="dropdown-item text-info" href="/schueler/logout">Logout</a>	 
						<?php else: ?>
						
							<!-- Schülerlogin -->
							<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
							<form action="/schueler/login" method="post" class="p-4 m-3" style="min-width: 200px;">
							<?php echo csrf_field(); ?>	
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
			</ul>
</nav>



<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/layouts/nav.blade.php ENDPATH**/ ?>