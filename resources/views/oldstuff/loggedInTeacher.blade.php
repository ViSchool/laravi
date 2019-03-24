@if (Auth::check())
<nav class="navbar m-0 justify-content-start bg-secondary d-none d-sm-block">
<!-- Navbar content -->
	<ul class="nav nav-pills">
		<i class="fas fa-wrench fa-2x fa-pull-right fa-border" style="color:white;"></i>
		<li class="nav-item">
			<a class="nav-link font-weight-bold text-white" href="#">Meine Unterrichtseinheiten</a>
		</li>
		<li class="nav-item">
			<a class="nav-link font-weight-bold text-white" href="#">Neue Unterrichtseinheit</a>
		</li>
		<li class="nav-item">
			<a class="nav-link font-weight-bold text-white"  href="#">Tools</a>
		</li>
	</ul>
</nav>

<div class="d-flex">
	<nav class="navbar fixed-top navbar-light d-block d-sm-none"> 
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTeacher" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon text-white"></span>
		</button>
		<div class=" collapse navbar-collapse" id="navbarTeacher">
			<div class="bg-secondary">
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link font-weight-bold text-white" href="#">Meine Unterrichtseinheiten</a>
					</li>
					<li class="nav-item">
						<a class="nav-link font-weight-bold text-white" href="#">Neue Unterrichtseinheit</a>
					</li>
					<li class="nav-item">
						<a class="nav-link font-weight-bold text-white"  href="#">Tools</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>
@endif