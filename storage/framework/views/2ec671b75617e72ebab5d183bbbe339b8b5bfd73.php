<!-- Navigation -->
 <div id="vischool_nav">
	<nav class="navbar fixed-top navbar-light d-flex mb-0">
		<a class="navbar-brand  mr-auto" href="/">ViSchool</a>
		
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
	
</div>

