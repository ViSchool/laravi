<!-- Navigation -->
 <div id="vischool_nav">
	<nav class="navbar fixed-top navbar-light d-flex mb-0">
		<a class="navbar-brand  mr-auto" href="http://vischool.net">ViSchool</a>
		
		<button type="button" class="btn btn-link"  data-toggle="collapse" data-target="#searchbox" aria-expanded="false" aria-controls="searchbox">
				<i class="fas fa-search"></i>
		</button>
		<div id="searchbox" class="collapse">
			<form class="form-inline">
				<input class="form-control" type="search" placeholder="Suche" aria-label="Suche">	
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit"></button>
			</form>
		</div>
		<?php if(Auth::check()): ?>
		<div id="userdata" class="collapse">
			<div class="card card-body border-info">
			<ul class="navbar-nav m-1">
				<li class="nav-item">
					<a class="nav-link" href="#">Deine Daten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/lehrer/logout">Logout</a>
				</li>
			</ul>
			</div>
		</div>
		<button type="button" class="btn btn-link"  data-toggle="collapse" data-target="#userdata" aria-expanded="false" aria-controls="userdata">
			 <i class="far fa-user"></i> <small><?php echo e(Auth::user()->name); ?></small>
		</button>
		<?php else: ?>
			<a class="btn btn-link m-0 p-3" href="/login">
					<small>Login</small> <i class="far fa-user"></i> 
			</a>
		<?php endif; ?>
	</nav>
	
	<div class="d-flex">
	 <nav class="navbar navbar-light d-none d-sm-block">
			<ul class="nav">
				<li class="nav-item active">
					<a class="nav-link" style="color:black;" href="#" >Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" style="color:black;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fächer</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="dropdown-item" href="/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color:black;" href="#">Lehrer</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color:black;" href="#">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color:black;" href="#">Impressum</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color:black;" href="/backend/">Admin</a>
				</li>
     		</ul>
		</nav>
	</div>
	
	<div class="d-flex">
	<nav class="navbar fixed-top navbar-light d-block d-sm-none"> 
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
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="dropdown-item" href="/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Lehrer</a>
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
</div>

