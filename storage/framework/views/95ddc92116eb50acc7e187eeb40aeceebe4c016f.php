<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<button class="btn" type="button" data-toggle="collapse" data-target="#admin_user" aria-expanded="false" aria-controls="admin_user">
		<i class="fas fa-user fa-inverse"> <?php echo e($admin->name); ?></i>
	</button>
        
	<a class="navbar-brand" href="#">Dashboard</a>
        
	<button class="navbar-toggler d-lg-none float-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/backend"> Übersicht
					<span class="sr-only">(current)</span>
				</a>
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
              <a class="nav-link" href="/backend/units">Unterrichtseinheiten</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/backend/portals">Lernportale</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/backend/tools">Tools</a>
            </li>
          </ul>
          
        </div>
      </nav>
		
    </header>